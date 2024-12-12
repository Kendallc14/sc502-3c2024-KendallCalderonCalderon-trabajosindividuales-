<?php
require 'comments.php';

$idComentario = crearComentario(18,'Primer comentario');
if($idComentario){
    echo 'Comentario creado exitosamente ' . $idComentario;
}else{
    echo 'No se creo el comentario';
}


$editado = editarComentario($idComentario, 'Primer Comentario editada');
if ($editado) {
    echo "Comentario editada exitosamente.\n";
} else {
    echo "Error al editar comentario.\n";
}


echo "Lista de Comentarios" . PHP_EOL;
$comentarios =  obtenerComentarioPorTarea(18);
if($idComentario){
    foreach($comentarios as $comentario){
        echo "ID: " .  $comentario["id"] . " Comentario: " . $comentario["comment"] . PHP_EOL;
    }
}



echo "Eliminando un comentario " . $idComentario . PHP_EOL;
 $eliminado = eliminarComentario($idComentario);
 if ($eliminado){
    echo "El comentario se elimino correctamente";
 }else  {  
    echo "Error al eliminar Comentario";
 }


$method = $_SERVER['REQUEST_METHOD'];
header('Content-Type: application/json');
session_start();
if(isset($_SESSION['user_id'])){
    //el usuario tiene sesion
    $user_id = $_SESSION['user_id'];
    logDebug($user_id);
    switch ($method) {
        case 'GET':
            //devolver las tareas del usuario conectado
            $tareas = obtenerComentarioPorTarea($task_id);
            echo json_encode($comentario);
            break;
        
        default:
            http_response_code(405);
            echo json_encode(["error"=> "Metodo no permitido"]);
            break;
    }

}else{
    http_response_code(401);
    echo json_encode(["error" => "Sesion no activa"]);
}