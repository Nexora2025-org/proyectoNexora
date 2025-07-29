<?php
require_once 'configdb.php';
require_once 'usuario.php';
require_once 'agenda.php';
$usuarioObj = new Usuario($conn);
$agendaObj = new Agenda($conn);
$method = $_SERVER['REQUEST_METHOD'];
// Obtiene el endpoint de la solicitud
$endpoint = $_SERVER['PATH_INFO'];
// Establece el tipo de contenido de la respuesta (json)
header('Content-Type: application/json');

switch ($method) {
    //GET
    case 'GET':
        
        if($endpoint === '/usuarios'){
            $usuarios = $usuarioObj->getAllUsuarios();
            echo json_encode($usuarios);
        } elseif (preg_match('/^\/usuarios\/(\d+)$/', $endpoint, $matches)) {
            $usuarioId = $matches[1];
            $usuario = $usuarioObj->getUsuarioById($usuarioId);
             echo json_encode($usuario);
        }
   
        if($endpoint === '/agendas') {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $agendaObj->getAppointments();
            if ($result>=0) {
                echo json_encode(['success' => true, 'agendas' => $result]);
            } else {
                echo json_encode(['success' => false, 'error' => $result]);
            }
        }
     break;
    //POST
    case 'POST':
        if($endpoint === '/login') {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $usuarioObj->getUserByID($data['usr_ci']);
            
            if ($result) {
                if(password_verify($data['usr_pass'], $result['contraseña'])){
                    echo json_encode(['success' => true, 'user' => $result]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Contraseña incorrecta']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Hubo un error con tu solicitud']);
            }
                    exit;
        }
        if($endpoint === '/uploadImage') {
            require_once './functions/uploadImage.php';
                    exit;
        }
        if($endpoint === '/Setappointment'){
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $agendaObj->setAppointments($data);
            if ($result) {
                echo json_encode(['success' => true , 'agenda' => $result]);
            } else {
                echo json_encode(['success' => false]);
            }
            exit;
        }
        if($endpoint === '/addUsuario') {
           try {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $usuarioObj->addUser($data);

     if ($result) {
        echo json_encode(['success' => true,'message' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => $result]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error interno del servidor.',
        'error' => $e->getMessage()
    ]);
}
        exit;
        }
    break;
    //PUT
    case 'PUT':
        if ($endpoint === '/actualizarInfo') {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $usuarioObj->updateUsuario($data);

        if ($result) {
            $updatedUser = $usuarioObj->getUserByID($data['CI']);
            echo json_encode([
                'success' => true,
                'user' => $updatedUser
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
        if($endpoint === '/actualizarAgenda') {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $agendaObj->updateAgenda($data);
            if ($result) {
                $updatedAgenda = $agendaObj->getAppointmentsByCI($data['CI']);
                echo json_encode(['success' => true, 'agenda' => $updatedAgenda]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        break;

    //DELETE
    case 'DELETE':
       if (preg_match('/^\/agendas\/(\d+)$/', $endpoint, $matches)) {
        $agendaCI = $matches[1];

        // Asegúrate de que tengas este método en tu clase Agenda
        $result = $agendaObj->deleteAppointment($agendaCI);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se pudo eliminar la agenda.']);
        }
    }
        break;
    default:
        // Maneja otras solicitudes
        break;
}
?>