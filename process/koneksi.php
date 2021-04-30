<?php
    $servername="localhost";
    $database="db_logistic";
    $username="root";
    $password="";

    $conn = mysqli_connect($servername,$username,$password,$database);
        if(mysqli_connect_errno())
        {
            echo'Koneksi Gagal:'.mysqli_connect_error();
        }
        else {
        }
    error_reporting(0);
?>
