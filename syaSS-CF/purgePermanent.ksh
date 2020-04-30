#!/bin/ksh
###############################################################################
#
# Name:       	purgePermanent.ksh
# Author:	Yang Chen 
# Director:	Kerry O'Brien
#
# This scripts will purge the permanent files stored on the Content Manager.
# 
# !!!!!!!!
# !!! IT SHOULD ONLY BE USED WHEN THE UNDERLINE CSE DATABASE IS PURGED IN DEV.
# !!!!!!!!
#
# The scripts takes five properties:
# 
# 1. cm.environment - environment to delete the file. i.e TEAM05
# 2. cm.server      - DB profile that points to Content Manager. i.e. ICMLS19
# 3. cm.user        - CM user account. i.e. docmgmt1
# 4. cm.password    - CM user password.
# 5. cm.maxrecords  - Max number of records to delete. -1 for all.
# 6. cm.createdate  - create date, YYYYMMDD. to only delete documents
#                     that are created prior to date specified.
# 7. cm.priordays  -  relative number of days. to only delete documents
#                     that are created prior to date.
# 
# There are two ways to set these properties required by the purger.
#
# 1. through the properties file, which is located at 
#       ../resources/ContentManagerPurger.properties
# 2. through the command line argument -Dkey=value
#
# The program will reads the properties file first and then it will 
# will read the runtime argument if presented.
#
# History:
#   12-27-06 Kerry Added JVM sizes to startup. Changed to use the new
#                  setRuntimeEnv.ksh.
#
###############################################################################
PARMS=$*

export USER_INSTALL_PROP="-Xms128m -Xmx512m"

#
# set EAR_ROOT= to where the EAR has be extracted.
#
cmdPath=`which $0`
cmdDir=`dirname ${cmdPath}`
EAR_ROOT=${cmdDir}/..

. ${cmdDir}/setRuntimeEnv.ksh $EAR_ROOT

${WAS_HOME}/bin/launchClient.sh ${EAR_ROOT} -CCjar=ContentManagerPermanentFilePurgerClient.jar -CCverbose=true -CCclasspath=$DB2DRIVER:${EAR_ROOT}/resources:$TCP ${PARMS}