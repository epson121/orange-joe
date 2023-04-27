<?php

namespace Roberto\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TemplateController {

    public function handle(Request $request): Response
    {    
        extract($request->attributes->all(), EXTR_SKIP);

        ob_start();
        include sprintf(__DIR__.'/../../src/%s.php', $_route);

        return new Response(ob_get_clean());
    }

}