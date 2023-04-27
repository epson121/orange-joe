<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class IndexTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testHello()
    {
        $request = Request::create('/hello/Orange');

        require '/var/www/html/public/index.php';

        /**@var \Symfony\Component\HttpFoundation\Response $response */
        $this->assertNotNull($response);

        $content = $response->getContent();
        $this->assertStringContainsString('Hello Orange', $content);

    }

    /**
     * @runInSeparateProcess
     */
    public function testBye()
    {
        $request = Request::create('/bye');

        require '/var/www/html/public/index.php';

        /**@var \Symfony\Component\HttpFoundation\Response $response */
        $this->assertNotNull($response);

        $content = $response->getContent();
        $this->assertStringContainsString('Goodbye', $content);

    }
}