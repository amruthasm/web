<?php
require_once './session.php';
require_once '../db/db.class.php';

$db = new DB();

$selectBookings = "SELECT * FROM booking AS b"
        . " JOIN user AS u ON (b.user_rid = u.user_rid)"
        . " JOIN mall AS m ON (b.mall_rid = m.mall_rid)"
        . " JOIN slots AS s ON (b.slot_rid = s.slot_rid)"
        . " ORDER BY `name` ASC";
$bookings = $db->executeSelect($selectBookings);
?>

<html>

    <?php require_once '../include/header.php'; ?>

    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container mt-4">
            <div class="card">
                <div class="card-body">
                    <h3>Bookings</h3>
                    <hr>
                    <table class="table table-hover table-bordered">
                        <thead> <tr>
                                <th>Sl. No</th>
                                <th>User Name</th>
                                <th>Mobile</th>
                                <th>Mall Name</th>
                                <th>Slot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($bookings as $booking) {
                                ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $booking['name']; ?></td>
                                    <td><?php echo $booking['mobile']; ?></td>
                                    <td><?php echo $booking['mall_name']; ?></td>
                                    <td><?php echo $booking['vehicle_type'] . ' - ' . $booking['slot_number']; ?></td>
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