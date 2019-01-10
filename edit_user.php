<?php
    /**
     * Created by PhpStorm.
     * User: Silverio
     * Date: 18/01/2017
     * Time: 11:51
     */
    require_once ('models/User.php');
    require_once ('util/debug.php');
    require_once ('util/db_manager.php');


    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: index.php');
    }

    if (!isset($_GET['user_id'])){
        header('Location: index.php');
    }
    else{
        $selected_user = get_user_from_id($_GET['user_id']);
        if ($selected_user == null){
            header('Location: index.php');
        }
    }
    $user = $_SESSION['user'];

    if (isset($_POST['save'])){
        $update_error = 0;

        $name = strtolower($_POST['name']);
        $userName = strtolower($_POST['username']);
        $surnames = strtolower($_POST['surnames']);
        $email = strtolower($_POST['email']);

        $selected_user->setName($name);
        $selected_user->setUsername($userName);
        $selected_user->setSurnames($surnames);
        $selected_user->setEmail($email);

        if (!update_user($selected_user)){
            $update_error = 1;
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title><?php echo ucfirst($selected_user->getName()); ?> edit page</title>
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
        </div>
        <div class="container">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <?php
                        if (isset($update_error)){
                            if ($update_error != 0){
                                $msg = 'Error to update user';
                                show_alert($msg, 'danger');
                            }
                            else{
                                $msg = 'User Updated correctly';
                                show_alert($msg, 'success');
                            }
                        }
                    ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2>Edit profile of <strong><?php echo ucfirst($selected_user->getName()).' '.ucfirst($selected_user->getSurnames()).' ('.ucfirst($selected_user->getUsername()).')' ; ?></strong></h2>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF'].'?user_id='.$selected_user->getId();?>" method="post">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="name">ID: </label>
                                    <input name="name" class="form-control" value="<?php echo $selected_user->getId(); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name: </label>
                                    <input name="name" class="form-control" value="<?php echo $selected_user->getName(); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="surnames">Surnames: </label>
                                    <input name="surnames" class="form-control" value="<?php echo $selected_user->getSurnames(); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username: </label>
                                    <input name="username" class="form-control" value="<?php echo $selected_user->getUsername(); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password: </label>
                                    <input name="password" class="form-control" value="<?php echo $selected_user->getPassword(); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email: </label>
                                    <input name="email" class="form-control" value="<?php echo $selected_user->getEmail(); ?>">
                                </div>

                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-primary btn-lg" name="save"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-sm-2"></div>

            </div>
        </div>
    </body>
</html>