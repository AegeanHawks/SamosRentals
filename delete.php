<?php
/**
 * Created by PhpStorm.
 * User: Nickos
 * Date: 3/5/2015
 * Time: 4:32 μμ
 */
include 'admin/configuration.php';
session_start();

//Check if user is logged
if (islogged()) {

    //Connect
    $con = db_connect();
    if ($con->connect_errno) {
        return;
    }

    debug_to_console('true');
    //To Delete user account
    if ($_GET['account'] == 'my') {
        // SQL query to fetch information of user.
        $sql = $con->prepare('DELETE FROM user WHERE Username= ?');
        $sql->bind_param('s', $_SESSION['userid']);
        $sql->execute();

        debug_to_console('true');
        //End session
        if (session_destroy()) // Destroying All Sessions
        {
            die(header('Location: index.php')); // Redirecting To Home Page
        }
    }

    $con->close();
    //To Delete a hotel
}