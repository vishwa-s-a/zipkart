<!-- this is mainly for connecting to the database -->
<?php
$con=mysqli_connect('localhost','root','','zipkart');
if(!$con)
{
    echo "Connection unsuccessful";
}

?>