<?php
session_start();
$servername="localhost";
$username="root";
$dbname="neuleaf";

$conn=new mysqli($servername,$username,'',$dbname);
if($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}     
       
?>
