#!/usr/bin/ksh

. ~/.profile

#Development
/cse/utilities/applications/CMPurger/CMTemporaryPurger/scripts/purgeTemporary.ksh -Dcm.server=cm_ap019 -Dcm.user=docmgmt1 -Dcm.password=cm1234cm -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,DEV01,TEAM01,TEAM03,TEAM04,TEAM05,TEAM06,TEAM07,TEAM08,TEAM09,TRN01,TRN02,TRN03,TRN04,UIT03,UIT04,UIT05

#System Test
/cse/utilities/applications/CMPurger/CMTemporaryPurger/scripts/purgeTemporary.ksh -Dcm.server=cm_h12a -Dcm.user=docmgmt1 -Dcm.password=cm1234cm -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,SYT01,SYT02,SYT03,SYT04,SYT06,SYT07,SYT08,SYT11,SYT12

#SQT

/cse/utilities/applications/CMPurger/CMTemporaryPurger/scripts/purgeTemporary.ksh -Dcm.server=cm_ap050 -Dcm.user=sqt01 -Dcm.password=Qlt1T3st -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,DEV01,SQT01,SQT02,SQT03

#Performance Test
/cse/utilities/applications/CMPurger/CMTemporaryPurger/scripts/purgeTemporary.ksh  -Dcm.server=cm_ds009 -Dcm.user=pft09cm -Dcm.password=L0ckd0wn -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,DEV01,PFT01,PFT02,PFT03,PFT04,PFT05,PFT06,PFT07,PFT08,PFT09CM

#Performance 2 Test
/cse/utilities/applications/CMPurger/CMTemporaryPurger/scripts/purgeTemporary.ksh  -Dcm.server=cm_p06a -Dcm.user=pft02cm -Dcm.password=L0ckd0wn -Dcm.environment=IMGADMIN,DOCMGMT,DOCMGMT1,DOCMGMT2,DEV01,PFT01,PFT02,PFT03,PFT04,PFT05,PFT06,PFT07,PFT08,PFT02CM
