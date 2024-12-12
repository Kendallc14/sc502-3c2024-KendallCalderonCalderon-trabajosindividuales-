<?php
require 'db.php';//conexion a la base de datos

function userRegistry($username, $password, $email) {  //recibe los datos de usuario como parametro 
    try {
        global $pdo;//acceder a la variable PDO que esta en db.php
        $passwordHashed = password_hash($password,PASSWORD_BCRYPT); //Encriptacion de contraseña
        $sql = "INSERT INTO users(username, password, email) values (:username, :password, :email)";//Creamos el insert en nuestra base de datos (El nuevo usuario)
        $stmt = $pdo ->prepare($sql);
        $stmt -> execute(['username' => $username,'password' => $passwordHashed,'email'=> $email]);
        logDebug("Usuario Registrado");
        return true;

    } catch (Exception $e) {
        logError("Ocurrio un error" . $e->getMessage());
        return false;
    }
}

$method = $_SERVER['REQUEST_METHOD'];
 
if($method == 'POST'){
    if(isset($_POST['email']) && isset($_POST['password'])){
        $username = $_POST['email'];
        $password = $_POST['password'];
        if(userRegistry($username, $password,$username )){
            http_response_code(200);
            echo json_encode(["message" => "Registro exitoso "]);
        }else{
            http_response_code(500);
            echo json_encode(["error" => "Eror registrando el usuario"]);
        }
 
    }else{
        http_response_code(400);
        echo json_encode(["error" => "Email y password son requeridos"]);
    }
 
}else{
    http_response_code(405);
    echo json_encode(["error"=> "Metodo not permitido"]);
}

