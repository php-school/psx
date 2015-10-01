<?php

namespace PhpSchool\PSXTest;

use PhpSchool\PSX\Factory;
use PhpSchool\PSX\SyntaxHighlighter;
use PHPUnit_Framework_TestCase;

/**
 * Class FactoryTest
 * @package PhpSchool\PSXTest
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $factory = new Factory;
        $this->assertInstanceOf(
            SyntaxHighlighter::class,
            $factory->__invoke()
        );
    }
}
