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
    case 'GET':
        if($endpoint === '/usuarios'){
            // Obtiene todos los usuarios
            $usuarios = $usuarioObj->getAllUsuarios();
             json_encode($usuarios);
        } elseif (preg_match('/^\/usuarios\/(\d+)$/', $endpoint, $matches)) {
            // Obtiene un usuario por ID
            $usuarioId = $matches[1];
            $usuario = $usuarioObj->getUsuarioById($usuarioId);
             json_encode($usuario);
        }
   
        if($endpoint === '/agendas') {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $agendaObj->getAppointments();
            if ($result) {
                echo json_encode(['success' => true, 'agendas' => $result]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        break;
    case 'POST':
            if($endpoint === '/login') {
            $data = json_decode(file_get_contents('php://input'), true);
            $result = $usuarioObj->getUserByID($data['usr_ci']);
            
            if ($result) {
                if(md5($data['usr_pass']) === $result['contraseña']){
                    echo json_encode(['success' => true, 'user' => $result]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Contraseña incorrecta']);
                }
            } else {
                 json_encode(['success' => false, 'error' => 'Hubo un error con tu solicitud']);
            }
        }
        break;
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
        break;
    case 'DELETE':
        // Procesa la solicitud DELETE
        break;
    default:
        // Maneja otras solicitudes
        break;
}
?>