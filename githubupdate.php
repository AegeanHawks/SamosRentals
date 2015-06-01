<?php
define('PRIVATE_KEY', '#github#samosrentals#project#');

echo shell_exec("git pull");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_REQUEST['secret'] === PRIVATE_KEY) {
    echo shell_exec("git pull");
    echo 'Everything Worked!!';
}
