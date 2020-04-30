#!/usr/bin/bash
#echo "Enter Old Password :"
#read -s -p "Enter Old Password:" oldpass
#echo ""
#read -s -p  "Enter New Password:" newpass
oldpass="Passw0rd!"
newpass="Ll!b3r3ty"

cat serverslist.txt | while read line; do
echo $line $oldpass $newpass
#	./accpet.xp $line
	./xchangepwd.xp $oldpass $newpass  $line
#	./script.exp $oldpass $newpass $line
done
