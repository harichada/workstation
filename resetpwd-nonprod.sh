#!/usr/bin/bash
cat cseonlinesqt.txt | while read line; do
	echo $line
	./resetuser.exp hc123 Lasya@123 $line
done
