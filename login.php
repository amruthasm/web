<?php
session_start();

require_once '../db/db.class.php';

$db = new DB();

$error = '';

if (isset($_GET['error'])) {
    $error = $_GET['error'];
}

if (isset($_POST['command'])) {
    $userName = $_POST['username'];
    $password = $_POST['password'];

    $selectUser = "SELECT * FROM `user` WHERE user_name = '$userName' AND password = '$password'";

    $user = $db->executeSelect($selectUser);

    if (!empty($user)) {
        $u = $user[0];

        $_SESSION['user'] = $u;
        $_SESSION['login'] = true;

        header('location: home.php');
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html>

    <?php
    require_once '../include/header.php';
    ?>

    <body>

        <?php
        require_once '../include/navbar.php';
        ?>

        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">User Login</h3>
                            <hr>
                            <form method="post" action="#">
                                <input type="hidden" name="command" value="login">
                                <div class="form-group">
                                    <input class=form-control type="text" id="username" name="username"
                                           placeholder="Username" autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <input class=form-control type="password" id="password" name="password"
                                           placeholder="Password" autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-secondary btn-block">Sign In</button>
                                </div>

                                <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger text-center">
                                        <?php echo $error; ?>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once '../include/footer.php';
        ?>
    </body>
</html>