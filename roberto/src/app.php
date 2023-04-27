<?php

use Symfony\Component\Routing;
use Symfony\Component\Routing\Route;


$routes = new Routing\RouteCollection();

# render 'hello' template
$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => 'Roberto\Controllers\TemplateController::handle'
]));

# render 'bye' template
$routes->add('bye', new Route('/bye', [
    '_controller' => 'Roberto\Controllers\TemplateController::handle'
]));

# calculate if this is a leap year, and return response
$routes->add('is_leap_year', new Route('/is_leap/{year}', [
    'year' => 2023,
    '_controller' => 'Roberto\Controllers\LeapYearController::handle'
]));

return $routes;