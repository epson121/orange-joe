<?php

use Symfony\Component\Routing;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;

$routes = new Routing\RouteCollection();

# render 'hello' template
$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => 'render_template'
]));

# render 'bye' template
$routes->add('bye', new Route('/bye', [
    '_controller' => 'render_template'
]));

# calculate if this is a leap year, and return response
$routes->add('is_leap_year', new Route('/is_leap/{year}', [
    'year' => 2023,
    '_controller' => function ($request) {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
]));

function is_leap_year($year = null) {
    if (null === $year) {
        $year = date('Y');
    }

    return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
}

function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/%s.php', $_route);

    return new Response(ob_get_clean());
}

return $routes;