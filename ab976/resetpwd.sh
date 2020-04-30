#!/usr/bin/bash
cat serverslist.txt | while read line; do
	echo $line
	./loginab.exp Passw0rd! $line
done
