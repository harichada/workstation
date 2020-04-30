read x
read y
read z
if (($x-$y==0))  || (($y-$z==0))
then
    if (($x-$z==0)) 
    then
        echo "EQUILATERAL"
    else
        echo "ISOSCELES"
    fi
elif (($x-$y!=0)) && (($x-$z!=0)) && (($y-$z!=0))
then
    echo "SCALENE"
elif (($x-$y==0)) && (($x-$z==0))
then
    echo "EQUILATERAL"
fi
