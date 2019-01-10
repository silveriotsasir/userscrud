<?php
/**
 * Created by PhpStorm.
 * User: Silverio
 * Date: 18/01/2017
 * Time: 13:48
 */
    require_once ('debug.php');
    $path = __DIR__.'/../models/User.php';
    require_once ($path);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = 'ciclo';

    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        $msg = "Connection failed: " . $conn->connect_error;
        show_alert($msg, 'danger');
    }


    function get_user ($username, $password){

        $sql = 'SELECT * FROM user WHERE userName="'.$username.'" AND password="'.$password.'"';
        $conn = $GLOBALS['conn'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $user_array = $result->fetch_assoc();
            return new User($user_array);
        }
        return null;
    }



    function get_user_from_id ($user_id){
        $sql = 'SELECT * FROM user WHERE id="'.$user_id.'"';
        $conn = $GLOBALS['conn'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $user_array = $result->fetch_assoc();
            return new User($user_array);
        }
        return null;
    }

    function get_users_array (){
        $sql = "SELECT * FROM user";
        $conn = $GLOBALS['conn'];
        $result = $conn->query($sql);
        $users = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($users, new User($row));
            }
        }
        return $users;
    }

    function update_user (User $user){
        // COMPLETAR UPDATE DE USUARIO

    }

    function delete_user ($user_id){
        // COMPLETAR ELIMINAR DE USUARIO

    }

    function save_user (User $user){
        // COMPLETAR PARA GUARDAR EL USUARIO

    }