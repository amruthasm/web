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
                            <h3 class="text-center">Add Mall</h3>
                            <hr>
                            <form action="actions.php" method="post" id="formAddMall" enctype="multipart/form-data">
                                <input type="hidden" name="command" value="addMall"/>

                                <div class="form-group">
                                    <select class="form-control" id="place" name="place">
                                        <option value="-1">-- Select Place --</option>
                                        <?php foreach ($places as $place) { ?>
                                            <option value="<?php echo $place['place_rid']; ?>"><?php echo $place['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" id="mallName" name="mallName"
                                           placeholder="Mall Name" autocomplete="off"/>
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" id="mallAddress" name="mallAddress"
                                              placeholder="Address" autocomplete="off"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="file" class="form-control" id="image" name="image"/>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-secondary btn-block" id="btnAddSlot">Add Mall</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once '../include/footer.php'; ?>
        <script src="../static/js/mall.js"></script>
    </body>
</html>