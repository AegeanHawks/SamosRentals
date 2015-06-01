<?php
define('PRIVATE_KEY', '#github#samosrentals#project#');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_REQUEST['thing'] === PRIVATE_KEY) {
    echo shell_exec("git pull");
}
