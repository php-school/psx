<?php

namespace PhpSchool\PSXTest;

use InvalidArgumentException;
use PhpSchool\PSX\SyntaxHighlighterConfig;
use PHPUnit_Framework_TestCase;

/**
 * Class SyntaxHighlighterConfigTest
 * @package PhpSchool\PSXTest
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class SyntaxHighlighterConfigTest extends PHPUnit_Framework_TestCase
{
    public function testExceptionIsThrownIfInvalidTypesSpecified()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Types: "type1", "type2" are not supported'
        );
        new SyntaxHighlighterConfig(['type1' => 'black', 'type2' => 'black']);
    }

    public function testExceptionIsThrownIfNotSupportedColourIsSpecified()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Colour: "notacolour" is not valid. Check: "PhpSchool\PSX\Colours"'
        );
        new SyntaxHighlighterConfig([SyntaxHighlighterConfig::TYPE_KEYWORD => 'notacolour']);
    }

    public function testGetColourForType()
    {
        $config = new SyntaxHighlighterConfig;
        $this->assertEquals('blue', $config->getColorForType(SyntaxHighlighterConfig::TYPE_KEYWORD));
    }

    public function testGetColourByTypeWhichDoesNotExistReturnsDefault()
    {
        $config = new SyntaxHighlighterConfig;
        $this->assertEquals('default', $config->getColorForType('lol-nope'));
    }
}
