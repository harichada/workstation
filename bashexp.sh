#!/usr/bin/bash
read -s pwd
/usr/bin/expect << EOD
spawn ssh cg1p02a 
expect "password"
send "$pwd\n"
EOD
echo $pwd
echo "successfully loged in"
