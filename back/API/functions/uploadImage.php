<?php
  if (isset($_FILES["profile_image"]) && isset($_POST['user_ci'])) {
            $file = $_FILES["profile_image"];
            $userCI = $_POST['user_ci'];
            
            // Validaciones
            $check = getimagesize($file["tmp_name"]);
            if ($check === false) {
                echo json_encode(["status" => "error", "message" => "El archivo no es una imagen."]);
                exit;
            }

            if ($file["size"] > 2000000) {
                echo json_encode(["status" => "error", "message" => "La imagen es demasiado grande (máx 2MB)."]);
                exit;
            }

            $allowed = ["jpg", "jpeg", "png", "gif"];
            $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            if (!in_array($imageFileType, $allowed)) {
                echo json_encode(["status" => "error", "message" => "Formato no permitido."]);
                exit;
            }

            // Crear directorio si no existe
            $target_dir = "../user_images/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Nombre único para la imagen
            $newFilename = "profile_" . $userCI . "_image.". $imageFileType;
            $destination = $target_dir . $newFilename;

            if (move_uploaded_file($file["tmp_name"], $destination)) {
                // Actualizar base de datos
               $result = $usuarioObj->updateUserImagePath($userCI, $newFilename);
                
                if ($result) {
                    // Obtener usuario actualizado
                    $updatedUser = $usuarioObj->getUserByID($userCI);
                    echo json_encode([
                        "status" => "success",
                        "message" => "Imagen subida con éxito.",
                        "filename" => $newFilename,
                        "user" => $updatedUser
                    ]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Error al actualizar la base de datos."]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Error al subir imagen."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "No se recibió imagen o CI de usuario."]);
        }
?>
