<?php
require_once 'db/db.class.php';

$db = new DB();

$selectPlace = "SELECT * FROM place ORDER BY `name` ASC";
$places = $db->executeSelect($selectPlace);

$placeId = -1;

if (isset($_GET['search'])) {
    $placeId = $_GET['place'];

    $selectMalls = "SELECT * FROM mall AS m"
            . " JOIN place AS p ON(m.place_rid = p.place_rid)"
            . " WHERE m.place_rid = $placeId ORDER BY mall_name ASC";
    $malls = $db->executeSelect($selectMalls);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pre Parking</title>
        <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-secondary">
            <a class="navbar-brand" href="#">Pre Parking</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="admin/login.php">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user/login.php">User Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user/registration.php">New User...?</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">Search Malls</h4>
                            <hr>
                            <form action="" method="get">
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
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-secondary" name="search">
                                        Search
                                    </button>
                                </div>
                            </form>
                            <?php if (!empty($malls)) { ?>
                                <div class="row justify-content-center">
                                    <?php foreach ($malls as $mall) { ?>
                                        <div class="card m-2" style="width: 18rem;">
                                            <img src="uploads/<?php echo $mall['image_url']; ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $mall['mall_name'] . ', ' . $mall['name']; ?></h5>
                                                <p class="card-text"><?php echo $mall['address']; ?></p>
                                                <a href="user/book_slot.php" class="btn btn-primary">Book</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="./static/js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="./static/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
