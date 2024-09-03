<?php 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "crud_Reinaldo";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn -> connect_error){
    die("Conexão falhou :( Ó: ".$conn -> connect_error);
}; 


?>