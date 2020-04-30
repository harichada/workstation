for line in `cat cseonlineprod.txt`
do
sshpass -p Lasya@123 ssh $line 
