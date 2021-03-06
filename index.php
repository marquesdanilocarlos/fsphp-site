<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */
use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ":");

/**
 * WEB ROUTES
 */
$route->namespace("Source\Controllers");
$route->get("/", "Web:home");
$route->get("/sobre", "Web:about");

/**
 * ERROR ROUTES
 */
$route->namespace("Source\Controllers")->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTES DISPATCH
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();