<?php

require 'db.php';

//Crear comentarios
function crearComentario($task_id, $comment)
{
    global $pdo;
    try {
        $sql = "INSERT INTO comments (task_id, comment) values (:task_id, :comment)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'task_id' => $task_id,
            'comment' => $comment
        ]);
        //devuelve el id del comentario creada en la linea anterior
        return $pdo->lastInsertId();
    } catch (Exception $e) {
        logError("Error creando comentario: " . $e->getMessage());
        return 0;
    }
}

//Editar comentario
function editarComentario($id, $comment)
{
    global $pdo;
    try {
        $sql = "UPDATE comments set comment = :comment where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt -> execute([
            'comment' => $comment,
            'id' => $id
        ]);
        $affectedRows = $stmt -> rowCount();
        return $affectedRows > 0;
    } catch (Exception $e) {
        logError($e->getMessage());
        return false;
    }
}



//obtenerComentarioPorUsuario
function obtenerComentarioPorTarea($task_id){
    global $pdo;
    try {
        $sql = "Select * from comments where task_id = :task_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['task_id' => $task_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        logError("Error al obtener Comentario: " . $e->getMessage() );
        return [];
    }
};


//Eliminar una comentario por id
function eliminarComentario($id){
    global $pdo;
    try {
        $sql = "delete from comments where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;// true si se elimina algo
    } catch (Exception $e) {
        logError("Error al eliminar la comentario: " . $e->getMessage() );
        return false;
    }
}
