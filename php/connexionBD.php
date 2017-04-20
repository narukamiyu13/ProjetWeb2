<?php 

// connecxion a la base de donne

$conn = mysqli_connect("localhost", "root", "", "foodie");

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}