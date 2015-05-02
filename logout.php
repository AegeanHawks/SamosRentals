<?php
/**
 * Created by PhpStorm.
 * User: Nickos
 * Date: 2/5/2015
 * Time: 5:06 πμ
 */

session_start();
if(session_destroy()) // Destroying All Sessions
{
    header("Location: index.php"); // Redirecting To Home Page
}
?>