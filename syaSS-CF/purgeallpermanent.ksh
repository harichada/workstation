#!/usr/bin/ksh
. ~/.profile

#INC0031215 - hold cron job for TEAM06 starting from 11/7/19 until 2/1/20
# TEAM/UIT - 14 day retention
/cse/utilities/applications/CMPurger/CMPermanentPurger/scripts/purgePermanent.ksh -Dcm.priordays=14 -Dcm.server=cm_ap019 -Dcm.user=docmgmt1 -Dcm.password=cm1234cm -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,DEV01,DEV02,TEAM04,TEAM05,TEAM09,UIT04,UIT05




# Split training from the development section to allow training environments to have their own purge schedule.
# This is to support the lengthy training classes that the team gives. This allows documents to remain for the duration of the classes.
# See Support Request CSE00362926.
# TRN - 180 day retention
/cse/utilities/applications/CMPurger/CMPermanentPurger/scripts/purgePermanent.ksh -Dcm.priordays=180 -Dcm.server=cm_ap019 -Dcm.user=docmgmt1 -Dcm.password=cm1234cm -Dcm.environment=TRN03,TRN04

# SYT - 14 day retention
/cse/utilities/applications/CMPurger/CMPermanentPurger/scripts/purgePermanent.ksh -Dcm.priordays=14 -Dcm.server=cm_h12a -Dcm.user=docmgmt1 -Dcm.password=cm1234cm -Dcm.environment=SYT01,SYT02,SYT03,SYT04,SYT05,SYT06,SYT07,SYT08,SYT09,SYT10,SYT11,SYT12

#SQT
/cse/utilities/applications/CMPurger/CMPermanentPurger/scripts/purgePermanent.ksh -Dcm.priordays=21 -Dcm.server=cm_ap050 -Dcm.user=sqt01 -Dcm.password=Qlt1T3st -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,DEV01,SQT01,SQT02,SQT03,SQT04

#Performance Test
/cse/utilities/applications/CMPurger/CMPermanentPurger/scripts/purgePermanent.ksh -Dcm.priordays=15 -Dcm.server=cm_ds009 -Dcm.user=pft01 -Dcm.password=perf21test -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,DEV01,PFT01,PFT02,PFT03,PFT04,PFT05,PFT06,PFT07,PFT08,PFT09CM

#Performance2 Test
/cse/utilities/applications/CMPurger/CMPermanentPurger/scripts/purgePermanent.ksh -Dcm.priordays=15 -Dcm.server=cm_p06a -Dcm.user=pft02cm -Dcm.password=L0ckd0wn -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,DEV01,PFT01,PFT02,PFT03,PFT04,PFT05,PFT06,PFT07,PFT08,PFT02CM
