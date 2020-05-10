servers = open('onlineservers.txt','r')
for srvr in syaservers.readlines() :
        newurlp = AdminConfig.getid("/Server:"+srvr+"/URLProvider:Default URL Provider/")
        env = srvr[:6]
#       print srvr
#       print env
        #AdminConfig.required('URL')
        name = ['name','EFS']
        spec = ['spec',"file:////usr/WebSphere/AppServer_85/profiles/AppServer/config/cseProperties/"+env+".EnterpriseFormService.properties"]
        jndi = ['jndiName','url/EFS']
        urlAttrs = [name,spec,jndi]
#       print spec
#       print newurlp
        print AdminConfig.create('URL',newurlp,urlAttrs)
        AdminConfig.save()