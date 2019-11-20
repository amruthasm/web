<?php
require_once './session.php';
require_once '../db/db.class.php';

$db = new DB();

$selectUsers = "SELECT * FROM user ORDER BY `name` ASC";
$users = $db->executeSelect($selectUsers);
?>

<html>

    <?php require_once '../include/header.php'; ?>

    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container mt-4">
            <div class="card">
                <div class="card-body">
                    <h3>Users</h3>
                    <hr>
                    <table class="table table-hover table-bordered">
                        <thead> <tr>
                                <th>Sl. No</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($users as $user) {
                                ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['mobile']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['address']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>

    </body>
</html>