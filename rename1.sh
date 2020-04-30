#!/usr/bin/bash
for i in `ls -la *.mhtml| awk '{print $NF}'`
do
	#fn=`awk '{split($0,a,"-"); print a[2]}' <<< $i`
	#`mv $i $fn`
	$(ex -sc '%s/.html\:/mhtml\:/g|x' $i)
	#`ex -sc '%s/\.html/\.mhtml/g|x' $i`
done
