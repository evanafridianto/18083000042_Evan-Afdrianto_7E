<?php
    $host = "localhost";   //Host
    $userdb = "root";    //User
    $password = ""; //Passsword
    $database = "uts"; 

$conn = mysqli_connect($host,$userdb,$password,$database);
 
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
else {echo "Koneksi berhasil";}


?>