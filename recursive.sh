#!/bin/bash

x=0

function tree()
{
	for i in $@
	do
		x=$((x+1))
		#echo $x
		#awk '{if ($1==1){print "\nline"}else{print "\ttab"}}' <<< $x
		#awk '{print  $x}' <<< $@
		if [ $x -eq 1 ]
		then
			echo -e '\n' $i
		else
			echo -e '\t' $i
		fi
			
	done
}
a="One Two Three"
tree $a
cat list.txt | while read line;
do
	x=0
	tree $line
done
