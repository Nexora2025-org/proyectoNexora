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

 public function updateUsuario($data) {
    $stmt = $this->conn->prepare("UPDATE Socio SET nombre = ?, apellido = ?, telefono = ?, direccion = ? WHERE CI = ?");
    
    if (!$stmt) {
        return false; // SI hay un error devolver false
    }

    $stmt->bind_param("ssssi", $data['nombre'], $data['apellido'], $data['telefono'], $data['direccion'], $data['ci']);

    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
}
?> 