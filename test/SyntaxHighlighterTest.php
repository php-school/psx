<?php

namespace PhpSchool\PSXTest;

use Colors\Color;
use PhpParser\ParserFactory;
use PhpSchool\PSX\ColorsAdapter;
use PhpSchool\PSX\Lexer;
use PhpSchool\PSX\SyntaxHighlighter;
use PhpSchool\PSX\SyntaxHighlighterConfig;
use PhpSchool\PSX\SyntaxHighlightPrinter;
use PHPUnit_Framework_TestCase;
use InvalidArgumentException;

/**
 * Class SyntaxHighlighterTest
 * @package PhpSchool\PSXTest
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class SyntaxHighlighterTest extends PHPUnit_Framework_TestCase
{
    public function testExceptionIsThrownIfCodeIsNotString()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'Argument 1 should be a string of valid PHP code'
        );
        $highlighter = $this->getHighlighter();
        $highlighter->highlight([]);
    }

    public function testExceptionIsThrownIfInvalidCode()
    {
        $this->setExpectedException(
            InvalidArgumentException::class,
            'PHP could not be parsed'
        );
        $highlighter = $this->getHighlighter();
        $highlighter->highlight('<?php echo');
    }

    public function testSyntaxHighlighter()
    {
        $code = '<?php echo "hello world!";';
        $highlighter = $this->getHighlighter();
        $expected = "[36m<?php[0m\n\n[33mecho[0m [32m'hello world!'[0m;";
        $this->assertEquals($expected, $highlighter->highlight($code));
    }

    /**
     * @return SyntaxHighlighter
     */
    private function getHighlighter()
    {
        $lexer = new Lexer([
            'usedAttributes' => [
                'comments', 'startLine', 'endLine', 'startFilePos', 'endFilePos', 'startTokenPos', 'endTokenPos'
            ]
        ]);
        
        $parserFactory = new ParserFactory;
        $color = new Color;
        $color->setForceStyle(true);
        return new SyntaxHighlighter(
            $parserFactory->create(ParserFactory::PREFER_PHP7, $lexer),
            new SyntaxHighlightPrinter(
                new SyntaxHighlighterConfig,
                new ColorsAdapter($color)
            )
        );
    }
}
