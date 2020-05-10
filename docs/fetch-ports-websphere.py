serverslist = []
for p in AdminApp.list().splitlines():
   for m in AdminApp.listModules( p, '-server' ).splitlines():
       if m.find('ArchImagingBootstrapWeb.war') > 0:
           ( iapp, module, server) = m.split('#')
           ( server1 ) = server.split('+')[0].split(',')[-1].split('=')[-1]
           serverslist.append(server1)
dict1 = { }
for x in AdminConfig.list('Server').splitlines():
# if x.split('(',1)[0].find('webserver') < 0 and x.split('(',1)[0].find('IHS') < 0:
 objName = AdminConfig.getObjectName(x)
 if len(objName) > 0:
  node = AdminControl.getAttribute(objName,'nodeName')
  ns = AdminConfig.getid("/Node:"+node+"/")
#  print AdminConfig.showAttribute(ns,'hostName')+" : " + x.split('(',1)[0]
  dict2 = { x.split('(',1)[0]:AdminConfig.showAttribute(ns,'hostName') }
  dict1.update(dict2)

def ListPort():
        servers = AdminConfig.list( 'ServerEntry' ).splitlines()
        for server in servers :
            ServerName = server.split( '(', 1 )[ 0 ]
            #print "System information: Server Name : " +  ServerName
            NamedEndPoints = AdminConfig.list( "NamedEndPoint" , server).split(lineSeparator)
            if ServerName in serverslist:
#               print "System information: Server Name : " +  ServerName
               for namedEndPoint in NamedEndPoints:
                    endPointName = AdminConfig.showAttribute(namedEndPoint, "endPointName" )
                    endPoint = AdminConfig.showAttribute(namedEndPoint, "endPoint" )
                    host = AdminConfig.showAttribute(endPoint, "host" )
                    port = AdminConfig.showAttribute(endPoint, "port" )
                    if endPointName == 'WC_defaulthost':
                        print  ServerName + " : " + port +" : " +dict1[ServerName]

ListPort()

PROD01_IF_Online_Cluster_1_Imaging
ArchImagingBootstrapWeb.war+WEB-INF/web.xml
WebSphere:cell=cg1p37aCell01,cluster=PROD01_IF_Online_Cluster_1
'SYT01_IF_Online_Imaging
ArchImagingBootstrapWeb.war+WEB-INF/web.xml
WebSphere:cell=cg1p10aCell01,node=cg1p10aNode01,server=SYT01_IF_Online+WebSphere:cell=cg1p10aCell01,node=cg1p12aNode01,server=webserver1'