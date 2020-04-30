#!/usr/bin/bash
cat cseonlineprod.txt | while read line; do
	echo $line
	./resetuserP.exp hc123 Shru@123 $line
done
