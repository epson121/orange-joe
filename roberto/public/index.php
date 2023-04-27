<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/app.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;


if (!isset($request)) {
    $request = Request::createFromGlobals();
}

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$response = new Response();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);
    $response = call_user_func_array($controller, $arguments);
} catch(\Exception $e) {
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response->send();