<?php
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'] . "/m6/" .$class_name . '.php';
});
?>