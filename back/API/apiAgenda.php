<?php
session_start();
require_once '.configdb.php';

$nombre = $_POST['name'];
$apellido = $_POST['surname'];
$correo = $_POST['email'];
$fecha_nac = $_POST['birthdate'];
$telefono = $_POST['phone'];
$ci = $_POST['CI'];
$fecha_cita = $_POST['appointment'];


$data = array(
    'usr_name' => $nombre,
    'usr_surname' => $apellido,
    'usr_email' => $correo,
    'birthdate' => $fecha_nac,
    'phone' => $telefono,
    'usr_ci' => $ci,
    'message' => $fecha_cita
);

try{
    $query= 'INSERT INTO Agendas(usr_name, usr_surname, usr_email, birthdate, phone, usr_ci, message) VALUES (?,?,?,?,?,?,?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssss', $data['usr_name'], $data['usr_surname'], $data['usr_email'], $data['birthdate'], $data['phone'], $data['usr_ci'], $data['message']);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION['success'] = 'Cita agendada exitosamente';
    header('Location: ../index.php#contact');
} catch (Exception $e) {
    $_SESSION['error'] = 'Error al agendar la cita: ' . $e->getMessage();
    header('Location: ../index.php#contact');
}
?>