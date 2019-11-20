<?php
session_start();
$_SESSION['registration'] = true;
?>
<html>

    <?php
    require_once '../include/header.php';
    ?>

    <body>

        <?php require_once '../include/navbar.php'; ?>

        <div class="container">
            <div class="row mt-4">
                <div class="col-md-8">
                    <h5>Instructions</h5>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Register</h3>
                            <hr>
                            <form method="post" action="actions.php" id="formRegistration">
                                <input type="hidden" name="command" value="register">
                                <div class="form-group">
                                    <input class=form-control type="text" id="name" name="name"
                                           placeholder="Name" autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <input class=form-control type="text" id="contactno" name="contactno"
                                           placeholder="Contact No" autocomplete="off" maxlength="10"/>
                                </div>
                                <div class="form-group">
                                    <input class=form-control type="email" id="email" name="email"
                                           placeholder="Email-ID" autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <textarea class=form-control rows="5" id="address" name="address"
                                              placeholder="Address" autocomplete="off"></textarea>
                                </div>

                                <div class="form-group">
                                    <input class=form-control type="text" id="username" name="username"
                                           placeholder="Username" autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <input class=form-control type="password" id="password" name="password"
                                           placeholder="Password" autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="btnRegister"
                                            class="form-control btn-secondary btn-block">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once '../include/footer.php';
        ?>

        <script src="../static/js/regsitration.js"></script>

    </body>
</html>
