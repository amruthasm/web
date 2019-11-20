<?php
require_once './session.php';
require_once '../db/db.class.php';

$db = new DB();

$selectFeedbacks = "SELECT * FROM feedback AS f"
        . " JOIN user AS u ON (f.user_rid = u.user_rid)"
        . " JOIN mall AS m ON (f.mall_rid = m.mall_rid)"
        . " ORDER BY fb_rid DESC";
$feedbacks = $db->executeSelect($selectFeedbacks);
?>

<html>

    <?php require_once '../include/header.php'; ?>

    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-body">
                    <h3>Feedbacks</h3>
                    <hr>
                    <table class="table table-hover table-bordered">
                        <thead> <tr>
                                <th>Sl. No</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Mall</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($feedbacks as $feedback) {
                                ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $feedback['name']; ?></td>
                                    <td><?php echo $feedback['mobile']; ?></td>
                                    <td><?php echo $feedback['mall_name']; ?></td>
                                    <td><?php echo $feedback['feedback_body']; ?></td>
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