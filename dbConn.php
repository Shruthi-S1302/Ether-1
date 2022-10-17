<?php

$db = mysqli_connect("localhost","root","","");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>