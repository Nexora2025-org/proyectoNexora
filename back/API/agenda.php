<?php

class Agenda {

    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getAppointments() {
        $query = "SELECT * FROM agendas";
         $result = mysqli_query($this->conn, $query);

    if (!$result) {
        return false; 
    }

    $appointments = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }

    return $appointments;
    }
}
?> 