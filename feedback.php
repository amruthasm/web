<?php
require_once '../db/db.class.php';

$db = new DB();

$selectPlace = "SELECT * FROM place ORDER BY `name` ASC";
$places = $db->executeSelect($selectPlace);
?>
<html>

    <?php
    require_once '../include/header.php';
    ?>

    <body>

        <?php require_once './navbar.php'; ?>

        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Feedback</h3>
                            <hr>

                            <form method="post" action="actions.php" id="formFeedback">
                                <input type="hidden" name="command" value="addFeedback">

                                <div class="form-group">
                                    <select class="form-control" id="place" name="place">
                                        <option value="-1">-- Select Place --</option>
                                        <?php
                                        foreach ($places as $place) {
                                            ?>
                                            <option value="<?php echo $place['place_rid']; ?>">
                                                <?php echo $place['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" id="mall" name="mall">
                                        <option value="-1">-- Select Mall --</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea id="feedback" name="feedback" class="form-control" rows="5"
                                              placeholder="Please write your feedback here.."></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block" id="saveFeedback">SAVE</button>
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
        <script src="../static/js/feedback.js"></script>
    </body>
</html>
