<?php
require_once './session.php';
require_once '../db/db.class.php';

$db = new DB();

$selectMalls = "SELECT * FROM mall ORDER BY mall_name ASC";
$malls = $db->executeSelect($selectMalls);
?>
<html>

    <?php require_once '../include/header.php'; ?>

    <body>

        <?php require_once './navbar.php'; ?>


        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">

                            <h3 class="text-center">Book Slot</h3>
                            <hr>

                            <form method="post" action="actions.php" id="formBookSlot">
                                <input type="hidden" name="command" value="bookSlot">

                                <div class="form-group">
                                    <input class=form-control type="text"
                                           id="date" name="date" placeholder="Booking Date (Ex. 31/10/1990)" autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="time" name="time">
                                        <option value="-1">-- Select Time --</option>
                                        <option value="06:00">06:00 AM</option>
                                        <option value="06:30">06:30 AM</option>
                                        <option value="07:00">07:00 AM</option>
                                        <option value="07:30">07:30 AM</option>
                                        <option value="08:00">08:00 AM</option>
                                        <option value="08:30">08:30 AM</option>
                                        <option value="09:00">09:00 AM</option>
                                        <option value="09:30">09:30 AM</option>
                                        <option value="10:00">10:00 AM</option>
                                        <option value="10:30">10:30 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="11:30">11:30 AM</option>
                                        <option value="12:00">12:00 PM</option>
                                        <option value="12:30">12:30 PM</option>
                                        <option value="13:00">01:00 PM</option>
                                        <option value="13:30">01:30 PM</option>
                                        <option value="14:00">02:00 PM</option>
                                        <option value="14:30">02:30 PM</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="mall" name="mall">
                                        <option value="-1">-- Select Mall --</option>
                                        <?php
                                        foreach ($malls as $mall) {
                                            ?>
                                            <option value="<?php echo $mall['mall_rid']; ?>">
                                                <?php echo $mall['mall_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select id="slot" name="slot" class="form-control">
                                        <option value="-1">-- Select Slot --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-secondary btn-block" id="btnCheckSlot">Check Availability</button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-secondary btn-block d-none" id="btnBookslot">Book</button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger btn-block d-none" id="btnPay">Pay</button>
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
        <script src="../static/js/booking.js"></script>
    </body>
</html>