<?php

$pluginsAutoLoad = [
//    "jquery" => [
//        "js" => ["jquery-3.4.1.min"],
//        "css" => null
//    ],
    "bootstrap" => [
        "js" => ["js/bootstrap.min","js/popper.min"],
        "css" => ["css/bootstrap.min"]
    ],
    "sweetalert" => [
        "js" => ["sweetalert2.all"],
        "css" => null,
    ],
    "owl-carousel" => [
        "js" => ["owl.carousel.min"],
        "css" => ["owl.carousel.min"]
    ],
    "mascara" => [
        "js" => ["mascara"],
        "css" => null,
    ],
    "alertify" => [
        "js" => ["js/alertify"],
        "css" => ["css/alertify"]
    ],
    "dropify" => [
        "js" => ["js/dropify.min"],
        "css" => ["css/dropify.min"],
    ]
];

// Salva como constant
defined("PLGUINS_AUTOLOAD") OR define("PLGUINS_AUTOLOAD", serialize($pluginsAutoLoad));