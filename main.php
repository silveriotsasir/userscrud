<?php
/**
 * Created by PhpStorm.
 * User: Silverio
 * Date: 12/01/2017
 * Time: 10:02
 */
    require_once ('models/User.php');
    require_once ('util/debug.php');
    require_once ('util/db_manager.php');

    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: index.php');
    }
    else{
        $user = $_SESSION['user'];
    }

    if (isset($_POST['logout'])){
        session_destroy();
        header('Location: index.php');
    }

    if (isset($_POST['edit_profile'])){
        header('Location: edit_user.php?user_id='.$user->getId());
    }

    if (isset($_POST['delete_user'])){
        $user_id = $_POST['user_id'];
        $delete_error = 0;
        if (!delete_user ($user_id)){
            $delete_error = 1;
        }
    }

    if (isset($_POST['add_user'])){
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
            $create_user_error = 0;
            if (!save_user (new User($user_array))){
                $create_user_error = 1;
            }

        }
        else{
            $msg = 'Passwords do not match';
            show_alert ($msg, 'danger');
        }
    }

    $users = get_users_array();


?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <title><?php echo ucfirst($user->getName()); ?> main page</title>
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

            <a href="index.php"><img src="img/web_icon.png" width="128px"></a>
            <h1>Proyect S<strong><span style="background-color: black">CRUD</span></strong>LETO</h1>
            <p>Welcome <strong><?php echo ucfirst($user->getName()).' '.ucfirst($user->getSurnames()).' ('.ucfirst($user->getUsername()).')' ; ?></strong></p>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="btn-group">
                    <button class="btn btn-success" name="edit_profile"> Edit profile </button>
                    <button type="submit" name="logout" class="btn btn-warning"> Logout </button>
                </div>
            </form>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <?php
                        if (isset($delete_error)){

                            if ($delete_error == 0){
                                $msg = 'User deleted correctly';
                                show_alert($msg, 'success');
                            }
                            else{
                                $msg = 'User not deleted';
                                show_alert($msg, 'danger');
                            }
                        }

                        if (isset($create_user_error)){
                            if ($create_user_error == 0){
                                $msg = 'User added correctly';
                                show_alert($msg, 'success');
                            }
                            else{
                                $msg = 'No user added';
                                show_alert($msg, 'danger');
                            }
                        }
                    ?>
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#add_user_modal"><span class="glyphicon glyphicon-plus"></span> Add User</button>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>password (encrypted)</th>
                            <th>Name</th>
                            <th>Surnames</th>
                            <th>email</th>
                            <th><span class="glyphicon glyphicon-wrench"></span> options </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        foreach ($users as $each_user){
                            $edit_user_option = '<a href="edit_user.php?user_id='.$each_user->getId().'" title="edit user"><span style="color: green" class="glyphicon glyphicon-user"></span> </a>';
                            $delete_user_option = '<a onclick="set_user(this)" data-user-id="'.$each_user->getId().'" data-toggle="modal" data-target="#delete_user_confirmation_modal" title="delete user"><span style="color: red" class="glyphicon glyphicon-trash"></span> </a>';
                            echo '<tr>';
                            echo '<td>'.$each_user->getId().'</td>';
                            echo '<td>'.$each_user->getUsername().'</td>';
                            echo '<td>'.$each_user->getPassword().'</td>';
                            echo '<td>'.$each_user->getName().'</td>';
                            echo '<td>'.$each_user->getSurnames().'</td>';
                            echo '<td>'.$each_user->getEmail().'</td>';
                            echo '<td>'.$edit_user_option.' </td>';
                            echo '<td>'.$delete_user_option.'</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>

        <!-- Delete user confirmation modal -->
        <div id="delete_user_confirmation_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Are you sure?</h4>
                    </div>
                    <div class="modal-body">
                        <p>You will delete an user from DB</p>
                    </div>
                    <div class="modal-footer">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <input type="hidden" id="user_id" name="user_id">
                            <button type="submit" class="btn btn-danger" name="delete_user"> Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div id="add_user_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="modal-title text-center">

                                <img src="img/web_icon_black.png" width="64px">
                                <h3>Add User</h3>
                                <p>Complete the form to add an user</p>
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
                            <button type="submit" class="btn btn-primary btn-lg" name="add_user">Add user</button>
                            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    <script type="text/javascript">
        function set_user(element) {
            var user_id = element.getAttribute('data-user-id');
            document.getElementById('user_id').value = user_id;
        }

        function clear_form(){
            var inputs = document.getElementsByClassName('input');
            for(var i=0; i<inputs.length; i++){
                inputs[i].value = "";
            }
        }
    </script>

    </body>
</html>
