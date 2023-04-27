<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class LeapYearTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testIsLeap()
    {
        $request = Request::create('/is_leap/2020');

        require '/var/www/html/public/index.php';

        /**@var \Symfony\Component\HttpFoundation\Response $response */
        $this->assertNotNull($response);

        $content = $response->getContent();
        $this->expectOutputString('Yep, this is a leap year!', $content);

    }

    /**
     * @runInSeparateProcess
     */
    public function testIsNotLeap()
    {
        $request = Request::create('/is_leap/2021');

        require '/var/www/html/public/index.php';

        /**@var \Symfony\Component\HttpFoundation\Response $response */
        $this->assertNotNull($response);

        $content = $response->getContent();
        $this->expectOutputString('Nope, this is not a leap year.', $content);

    }
}