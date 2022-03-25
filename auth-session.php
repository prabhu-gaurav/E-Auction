<?php
session_start();
include('db.php');
if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: db.php");
}

if(!$_SESSION['username'])
{
    header('Location: login.php');
}
