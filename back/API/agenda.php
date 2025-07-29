<?php

class Agenda {
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getAppointments() {
        $query = "SELECT * FROM Agendas";
        $result = $this->conn->query($query);
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    }
    public function getAppointmentsByCI($ci) {
        $query = "SELECT * FROM Agendas WHERE CI = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $ci);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        $stmt->close();
        return $appointments;
    }
    public function deleteAppointment($ci) {
        $query = "DELETE FROM agendas WHERE ci = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $ci);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    public function setAppointments($data) {
        if (!isset($data['CI'], $data['nombre'], $data['apellido'], $data['email'], $data['fecha_nacimiento'], $data['telefono'], $data['fecha_agendada'], $data['hora'])) {
             return false;
        }
         $query = 'INSERT INTO Agendas(CI, nombre, apellido, email, fecha_nacimiento, telefono, fecha_agendada, hora, estado_agenda) VALUES (?, ?, ?, ?, ?, ?, ?, ? , "pendiente")';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssss", $data['CI'], $data['nombre'], $data['apellido'], $data['email'], $data['fecha_nacimiento'], $data['telefono'], $data['fecha_agendada'], $data['hora']);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
public function updateAgenda($data) {
    $query = "UPDATE Agendas SET estado_agenda = ? WHERE CI = ?";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ss", $data['estado_agenda'], $data['CI']);
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}

}
?> 