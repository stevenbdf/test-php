<?php
require_once('../database.php');
require_once('../validator.php');
require_once('../models/usuarios.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action'])) {
    session_start();
    $usuario = new Usuarios;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if ($_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'read':
                if ($result['dataset'] = $usuario->readUsuarios()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
                break;
            case 'create':
                if($usuario->setCorreo($_POST['correo']) && $usuario->setClave($_POST['contraseña'])){
                    if ($usuario->createUsuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Operación fallida';
                    }
                }
                break;
            case 'update':
                if($usuario->setCorreo($_POST['correo']) 
                && $usuario->setClave($_POST['contraseña']) 
                && $usuario->setId($_POST['id'])){
                    if ($usuario->updateUsuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Operación fallida';
                    }
                }else{
                    $result['exception'] = 'Error al setear datos';
                }
                break;
           default:
                exit('Acción no disponible');
        }
    }else {
        exit('Acceso no disponible');
    }
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>
