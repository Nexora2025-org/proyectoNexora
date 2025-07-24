<?php
session_start();
require_once './API/configdb.php';
require_once './API/usuario.php';
$user = new Usuario($conn);

$data = [
    'usr_name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    'usr_surname' => filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    'usr_email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
    'birthdate' => $_POST['birthdate'],
    'phone' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING),
    'marital_status' => filter_input(INPUT_POST, 'marital_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    'lawful_resident' => filter_input(INPUT_POST, 'lawful_resident', FILTER_SANITIZE_NUMBER_INT),
    'message' => filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
    'usr_ci' => filter_input(INPUT_POST, 'CI', FILTER_SANITIZE_STRING)
];

try {
    $result =$user->createPerson($data);
    if (!$result) {
        $_SESSION['error'] = 'Error al crear el usuario: ';
    }
    $_SESSION['success'] = 'Usuario creado correctamente.';
} catch (Exception $e) {
    $_SESSION['error'] = 'Error al crear el usuario: ' . $e->getMessage();
}

header('Location: ../index.php#contact');
exit();
?>
