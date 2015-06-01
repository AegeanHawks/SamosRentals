<?php
require(__DIR__ . "/GitHubHandler.php");
define('PRIVATE_KEY', '');

use GitHubWebhook\Handler;

$handler = new Handler(PRIVATE_KEY, __DIR__);
if ($handler->handle()) {
    echo "OK";
} else {
    echo "Wrong secret";
}
