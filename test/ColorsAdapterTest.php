<?php

namespace PhpSchool\PSXTest;

use Colors\Color;
use PhpSchool\PSX\ColorsAdapter;
use PHPUnit_Framework_TestCase;

/**
 * Class ColorsAdapterTest
 * @package PhpSchool\PSXTest
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class ColorsAdapterTest extends PHPUnit_Framework_TestCase
{
    public function testColorAdapter()
    {
        $color = new Color;
        $color->setForceStyle(true);
        $adapter = new ColorsAdapter($color);
        $this->assertSame('[32mHELLO WORLD[0m', $adapter->colour('HELLO WORLD', 'green'));
    }

    public function testStringIsReturnedAsIsIfNoStyleExists()
    {
        $color = new Color;
        $color->setForceStyle(true);
        $adapter = new ColorsAdapter($color);
        $this->assertSame('HELLO WORLD', $adapter->colour('HELLO WORLD', 'not-a-style'));
    }
}
