<?php
require 'tasks.php';
 
$idTarea = crearTarea(3,'Primer tarea prueba','Primer tarea prueba', '2024-11-14');
if($idTarea){
    echo 'Tarea creada exitosamente ' . $idTarea;
}else{
    echo 'No se creo la tarea';
}

$editado = editarTarea($idTarea, 'Primer tarea editada', 'Primer pruba para editar una tarea', '2024-12-15');
if ($editado) {
    echo "Tarea editada exitosamente.\n";
} else {
    echo "Error al editar la tarea.\n";
}

echo "Lista de tareas" . PHP_EOL;
$tareas =  obtenerTareasPorUsuario(3);
if($tareas){
    foreach($tareas as $tarea){
        echo "ID: " . $tarea["id"] . " Titulo: " . $tarea["title"] . PHP_EOL;
    }
}

echo "Eliminando una tarea " . $idTarea . PHP_EOL;
 $eliminado = eliminarTarea($idTarea);
 if ($eliminado){
    echo "La tarea se elimino correctamente";
 }else  {  
    echo "Error al eliminar tarea";
 }

