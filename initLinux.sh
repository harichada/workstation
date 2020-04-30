groudadd staff

useradd -c  'Steven Garrett,steven.garrett@dcss.ca.gov,916-464-5266' sgarrett
useradd -c 'Hari Kishore Chada,harikishore.chada@dcss.ca.gov,916-464-5798' hchada
sudo usermod -aG staff,wheel sgarrett
sudo usermod -aG staff,wheel hchada

yum install lvm2
yum insall rsync
yum install sysstat
yum install nmap

yum update

#lsblk
sudo service auditd start
sudo /bin/systemctl start auditd.service
sudo chkconfig auditd on
sudo sysemctl enable auditd.service



