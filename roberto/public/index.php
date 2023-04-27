<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/app.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;


if (!isset($request)) {
    $request = Request::createFromGlobals();
}

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

$response = new Response();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = call_user_func($request->attributes->get('_controller'), $request);
} catch(\Exception $e) {
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response->send();