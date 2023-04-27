<?php

// framework/front.php
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
    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/%s.php', $_route);
    $response->setContent(ob_get_clean());
} catch(\Exception $e) {
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response->send();