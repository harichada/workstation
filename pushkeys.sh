#!/usr/bin/bash
cat nonprod.txt | while read line; do
./pushkeys.exp $line
done
