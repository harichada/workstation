read x
i=0
t=0
while (($i<$x))
do
	read y 
	t=$((t+y))
	i=$((i+1))
done
echo $t
