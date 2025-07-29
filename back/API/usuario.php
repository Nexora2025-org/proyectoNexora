<?php
class Usuario {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getAllUsers() {
        $query = "SELECT * FROM people";
        $result = mysqli_query($this->conn,$query);
        $users = [];
        while($rows = mysqli_fetch_assoc($result)) {
            $users[] = $rows;
        }
        return $users;
    }
    public function getUserByID($ci){
        $query = "SELECT * FROM Socio WHERE CI = $ci";
        $result = mysqli_query($this->conn, $query);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }
public function addUser($data) {
    if (!isset($data['CI'], $data['nombre'], $data['apellido'], $data['email'], $data['telefono'], $data['direccion'], $data['pago_mensual'], $data['estado_pago'], $data['rol'])) {
    return false;
}
    $query = "INSERT INTO Socio (
        CI, nombre, apellido, fecha_ingreso, email, telefono, direccion, contraseña, pago_mensual, estado_pago, rol
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
        return ['success' => false, 'message' => 'Error en prepare: ' . $this->conn->error];
    }
$CI         = $data['CI'];
$nombre     = $data['nombre'];
$apellido   = $data['apellido'];
$fecha      = date('Y-m-d');
$email      = $data['email'];
$telefono   = $data['telefono'];
$direccion  = $data['direccion'];
$pass       = password_hash($CI, PASSWORD_DEFAULT);
$mensual    = $data['pago_mensual'];
$estado     = $data['estado_pago'];
$rol        = $data['rol'];

    $stmt->bind_param("sssssssssss", $CI, $nombre, $apellido, $fecha, $email, $telefono, $direccion, $pass, $mensual, $estado, $rol);

    $result = $stmt->execute();

    if (!$result) {
        return ['success' => false, 'message' => 'Error en execute: ' . $stmt->error];
    }

    $stmt->close();

    return ['success' => true];
}

public function getUserImage($ci) {
    $query = "SELECT imagen FROM Socio WHERE CI = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $ci);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user ? $user['imagen'] : null;
}

    public function updateUserImagePath($ci, $imagePath) {
        $query = "UPDATE Socio SET imagen = ? WHERE CI = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $imagePath, $ci);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateUsuario($data) {
        $stmt = $this->conn->prepare("UPDATE Socio SET nombre = ?, apellido = ?, telefono = ?, direccion = ? WHERE CI = ?");
        $stmt->bind_param("ssssi", $data['nombre'], $data['apellido'], $data['telefono'], $data['direccion'], $data['CI']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?> 