<?php
    require_once ('models/User.php');
    require_once ('util/debug.php');
    require_once ('util/db_manager.php');

    session_start();
    if (isset($_SESSION['user'])){
        header('Location: main.php');
    }

    $login_error = 0;
    if (isset($_POST['login'])){
        $username = strtolower($_POST['username']);
        $password = sha1($_POST['password']);
        $user = get_user($username, $password);
        if ( $user != null){
            $_SESSION['user'] = $user;
            header('Location: main.php');
        }
        else{
            $login_error = 1;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Scrudleto Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="img/web_icon_black.png">
    <link rel="stylesheet" href="style/main.css" type="text/css">

</head>
<body>

<div class="jumbotron text-center">
    <img src="img/web_icon.png" width="128px">
    <h1>Proyect S<strong><span style="background-color: black">CRUD</span></strong>LETO</h1>
</div>

<div class="container">
    <div class="row">
        <?php

        if (isset($_POST['register'])){
            $username = strtolower($_POST['username']);
            $name = strtolower($_POST['name']);
            if ($_POST['password'] == $_POST['password_confirmation']){
                $password = sha1($_POST['password']);
                $password_validation_error = 0;
            }
            else{
                $password_validation_error = 1;
            }

            $surnames = "";
            if (isset($_POST['surnames'])){
                $surnames = strtolower($_POST['surnames']);
            }

            $email = "";
            if (isset($_POST['email'])){
                $email = strtolower($_POST['email']);
            }

            if ($password_validation_error == 0){

                $user_array = array();
                $user_array['id'] = 0;
                $user_array['username'] = $username;
                $user_array['password'] = $password;
                $user_array['name'] = $name;
                $user_array['surnames'] = $surnames;
                $user_array['email'] = $email;

                if (!save_user (new User($user_array))){
                    $msg = 'User not created';
                    show_alert ($msg, 'danger');
                }
                else{
                    $msg = 'User created';
                    show_alert ($msg, 'success');
                }

            }
            else{
                $msg = 'Passwords do not match';
                show_alert ($msg, 'danger');
            }
        }

        if ($login_error != 0){
            $msg = 'Not correct user';
            show_alert($msg, 'danger');
        }
        ?>
    </div>

    <div class="row">
        <div class="col-sm-4"></div>

        <div class="col-sm-4">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <h3>Login</h3>
                        <p>Enter using your account</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input name="username" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input name="password" type="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#register_modal">Register</button>
                        <button type="submit" class="btn btn-success btn-lg" name="login">Enter</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">

        </div>
    </div>
</div>

<!-- Modal -->
<div id="register_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
         <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-title text-center">

                        <img src="img/web_icon_black.png" width="64px">
                        <h3>Register</h3>
                        <p>Complete the form to get an user</p>
                    </div>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input name="username" type="text" class="form-control input" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input name="name" type="text" class="form-control input" required>
                        </div>
                        <div class="form-group">
                            <label for="surnames">Surnames: </label>
                            <input name="surnames" type="text" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label for="email">email: </label>
                            <input name="email" type="text" class="form-control input">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input name="password" type="password" class="form-control input" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm password: </label>
                            <input name="password_confirmation" type="password" class="form-control input" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clear_form()" class="btn btn-danger btn-lg">Clear</button>
                    <button type="submit" class="btn btn-primary btn-lg" name="register">Register</button>
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
         </form>
        </div>

    </div>
</div>

</body>
<script type="text/javascript">
    function clear_form(){
        var inputs = document.getElementsByClassName('input');
        for(var i=0; i<inputs.length; i++){
            inputs[i].value = "";
        }
    }
</script>
</html>
