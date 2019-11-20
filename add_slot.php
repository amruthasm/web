<?php
require_once './session.php';
require_once '../db/db.class.php';

$db = new DB();

$selectPlace = "SELECT * FROM place ORDER BY `name` ASC";
$places = $db->executeSelect($selectPlace);
?>

<html>

    <?php require_once '../include/header.php'; ?>

    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Add Slots</h3>
                            <hr>
                            <form action="actions.php" method="post" id="formAddSlot">
                                <input type="hidden" name="command" value="addSlot"/>

                                <div class="form-group">
                                    <select class="form-control" id="vehicleType" name="vehicleType">
                                        <option value="-1">-- Select Type --</option>
                                        <option value="2-Wheeler">2 Wheeler</option>
                                        <option value="4-Wheeler">4 Wheeler</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" id="place" name="place">
                                        <option value="-1">-- Select Place --</option>
                                        <?php foreach ($places as $place) { ?>
                                            <option value="<?php echo $place['place_rid']; ?>"><?php echo $place['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" id="mall" name="mall">
                                        <option value="-1">-- Select Mall --</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" id="slot" name="slot">
                                        <option value="-1">-- Select Slots --</option>
                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-secondary btn-block" id="btnAddSlot">Add Slot</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/slot.js"></script>
    </body>
</html>