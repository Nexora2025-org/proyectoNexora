<?php
//Este script procesa una petición del formulario de ingreso a la cooperativa
session_start();

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $marital_status = $_POST['marital_status'];
    $income = $_POST['income'];
    $lawful_resident= $_POST['lawful_resident'];
    $message= $_POST['message'];
    $CI = $_POST['CI'];

    
    //informacion de la BD
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'nexora';

//En la variable "conn" guardamos toda la informacion que usaremos para conectcarnos
//Para esto usaremos mysqli connect y le damos como parametros lo que requiere para entrar a la BD
// "mysqli_connect(hostname, username, password, database)", en caso de que falle tira un error

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$query = "INSERT INTO people(usr_name, usr_surname, usr_email, birthdate, phone, marital_status, income, lawful_resident, message, usr_ci)
 values ('$name','$surname' ,'$email', '$birthdate', '$phone', '$marital_status', '$income', '$lawful_resident', '$message' , '$CI');";
$result = mysqli_query($conn, $query);

if ($result) {
    $_SESSION['success'] = "Petición enviada correctamente ".$name;
    header('location:../index.php#contact');
} else {
    $_SESSION['error'] = "Error al enviar la petición: " . mysqli_error($conn);
    header('location:../index.php#contact');
}

?>