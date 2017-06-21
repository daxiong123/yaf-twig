<?php

namespace Aichong\tests;

use Aichong\Twig;

/**
 * Class TwigTest
 *
 * @package Aichong\tests
 */
class TwigTest extends TestCase
{

    /**
     * @var Twig
     */
    public static $twig;

    public function testConstruct()
    {
        @mkdir('/tmp/views/cache', 0755, true);

        self::$twig = new Twig('/tmp/views/', ['cache' => '/tmp/views/cache/']);

        $this->assertInstanceOf(Twig::class, self::$twig);
    }

    public function testGetTwig()
    {
        $this->assertInstanceOf(\Twig_Environment::class, self::$twig->getTwig());
    }

    public function testGetAndSet()
    {
        self::$twig->test = 'test';

        $this->assertEquals('test', self::$twig->test);

        self::$twig->assign('demo', '12345');

        $this->assertEquals('12345', self::$twig->demo);
    }
}
