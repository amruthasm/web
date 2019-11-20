<?php

require_once './session.php';
require_once '../db/db.class.php';

$db = new DB();

$message = array();

try {

    if (isset($_POST['command'])) {

        $command = $_POST['command'];

        if ('register' == $command) {
            $name = $_POST['name'];
            $contactno = $_POST['contactno'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $selectContact = "SELECT 1 FROM user WHERE mobile = '$contactno'";

            if (!empty($db->executeSelect($selectContact))) {
                throw new Exception("Duplicate contact number");
            }

            $selectEmail = "SELECT 1 FROM user WHERE email = '$email'";

            if (!empty($db->executeSelect($selectEmail))) {
                throw new Exception("Duplicate email");
            }

            $selectUserName = "SELECT 1 FROM user WHERE user_name = '$username'";

            if (!empty($db->executeSelect($selectUserName))) {
                throw new Exception("Duplicate user name");
            }

            $insertRegister = "INSERT INTO `user`(user_name, `password`, `name`, mobile, email, address, created_at)"
                    . " VALUES('$username', '$password', '$name', '$contactno', '$email', '$address', NOW())";

            $db->executeInsertAndGetId($insertRegister);

            $message['success'] = true;
            $message['data'] = "Registered Successfully!";

            // reset flag
            $_SESSION['registration'] = true;
        } else if ('bookSlot' == $command) {

            if (!isset($_SESSION['user'])) {
                throw new Exception("Session time out. Please re-login!");
            }

            $user = $_SESSION['user'];
            $userRid = $user['user_rid'];

            $date = $_POST['date'];
            $time = $_POST['time'];
            $mall = $_POST['mall'];
            $slot = $_POST['slot'];

            // convert from 31/10/2019 to 2019-10-31
            $date = implode('-', array_reverse(explode('/', $date)));
            $bookingDate = $date . ' ' . $time;

            $insertBooking = "INSERT INTO booking(user_rid, mall_rid, slot_rid, timing, created_at)"
                    . " VALUES('$userRid', '$mall', '$slot', '$bookingDate', NOW())";

            $db->executeInsertAndGetId($insertBooking);

            $message['success'] = true;
            $message['data'] = "Successfully Booked!";
        } else if ('addFeedback' == $command) {

            if (!isset($_SESSION['user'])) {
                throw new Exception("Session time out. Please re-login!");
            }

            $user = $_SESSION['user'];
            $userRid = $user['user_rid'];

            $place = $_POST['place'];
            $mall = $_POST['mall'];
            $feedback = $_POST['feedback'];

            $insertFeedback = "INSERT INTO feedback(user_rid, place_rid, mall_rid, feedback_body, created_at)"
                    . " VALUES('$userRid', '$place', '$mall', '$feedback', NOW())";

            $db->executeInsertAndGetId($insertFeedback);

            $message['success'] = true;
            $message['data'] = "Success!";
        }
    } else if (isset($_GET['command'])) {

        $command = $_GET['command'];

        if ('getSlots' == $command) {
            $mall = $_GET['mall'];

            $selectSlots = "SELECT *, CONCAT_WS(' - ', vehicle_type, slot_number) AS slot_name"
                    . " FROM slots WHERE mall_rid = $mall";

            $slots = $db->executeSelect($selectSlots);

            $message['success'] = true;
            $message['data'] = $slots;
        } else if ('checkSlot' == $command) {
            $date = $_GET['date'];
            $time = $_GET['time'];
            $mall = $_GET['mall'];
            $slot = $_GET['slot'];

            // convert from 31/10/2019 to 2019-10-31
            $date = implode('-', array_reverse(explode('/', $date)));
            $bookingDate = $date . ' ' . $time;

            $hasBooked = "SELECT 1 FROM booking"
                    . " WHERE timing = '$bookingDate' AND mall_rid = $mall AND slot_rid = $slot";

            $booking = $db->executeSelect($hasBooked);

            if (!empty($booking)) {
                throw new Exception("Selected slot is already booked!");
            } else {
                $message['success'] = true;
                $message['data'] = "Available!";
            }
        } else if ('getMallList' == $command) {
            $place = $_GET['place'];

            $selectMalls = "SELECT * FROM mall WHERE place_rid = $place ORDER BY mall_name ASC";

            $malls = $db->executeSelect($selectMalls);
            $message['success'] = true;
            $message['data'] = $malls;
        }
    } else {
        throw new Exception("Invalid HTTP request");
    }
} catch (Exception $ex) {
    $message['success'] = false;
    $message['data'] = $ex->getMessage();
}

echo json_encode($message);

