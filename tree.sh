awk 'BEGIN{pos[0]=49; res=""; L=16; cl=0}
{
p=1;
for(l=0;l<$N;l++){
    for(cnt=0;cnt<L;cnt++){
        s="";
        for(i=0;i<100;i++){
            fl=0;
            for(j=0;j<p;j++) if(i == pos[j]) fl=1;
            if(fl == 1) s=s"1";
            else s=s"_";
        }
        res=s"\n"res;
        cl=cl+1;
    }
    for(i=p-1;i>=0;--i){
        pos[i*2+1]=pos[i]+1;
        pos[i*2]=pos[i]-1;
    }
    p=p*2;
    for(cnt=0;cnt<L;cnt++){
        s="";
        for(i=0;i<100;i++){
            fl=0;
            for(j=0;j<p;j++) if(i == pos[j]) fl=1;
            if(fl == 1) s=s"1";
            else s=s"_";
        }
        res=s"\n"res;
        cl=cl+1;
        if(cnt != L-1)
            for(j=0;j<p;j++) pos[j]=pos[j]+(j%2?1:-1);
    }
    L=L/2;
}
for(i=cl;i<63;i++){
    s="";
    for(j=0;j<100;j++) s=s"_";
    res=s"\n"res;
}
}
END{print res;}'
