PHP CLI Syntax Highlighter
===========
[![Build Status](https://img.shields.io/travis/php-school/psx.svg?style=flat-square&label=Linux)](https://travis-ci.org/php-school/psx)
[![Windows Build Status](https://img.shields.io/appveyor/ci/AydinHassan/psx/master.svg?style=flat-square&label=Windows)](https://ci.appveyor.com/project/AydinHassan/psx)
[![Coverage Status](https://img.shields.io/codecov/c/github/php-school/psx.svg?style=flat-square)](https://codecov.io/github/php-school/psx)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/php-school/psx.svg?style=flat-square)](https://scrutinizer-ci.com/g/php-school/psx/)

This is a tool to syntax highlight PHP code for display on a terminal. It takes in an AST produced by [nikic/php-parser](https://github.com/nikic/PHP-Parser)
and prints the code. It only decorates a subset of the language. It is literally a copy-paste of [PrettyPrinter/Standard](https://github.com/nikic/PHP-Parser/blob/39a039fa4257d3b9209de36cc54f5d3f5d6253f5/lib/PhpParser/PrettyPrinter/Standard.php) 
with some decorating added around the printing.

## Usage

```php
use PhpSchool\PSX\Factory;

$highlighterFactory = new Factory;
$highlighter = $highlighterFactory->__invoke();

echo $highlighter->highlight($phpCode);
```

The colouring by default uses [kevinlebrun/colors.php](https://github.com/kevinlebrun/colors.php). You can use any library you want
by building an adapter class which implements `\PhpSchool\PSX\ColourAdapterInterface`, you will need to map the colours in `\PhpSchool\PSX\Colours` to your library.

## Customising Colours

```php
use PhpParser\ParserFactory;
use Colors\Color;
use PhpSchool\PSX\SyntaxHighlighter;
use PhpSchool\PSX\SyntaxHighlightPrinter;
use PhpSchool\PSX\SyntaxHighlighterConfig;
use PhpSchool\PSX\ColorsAdapter;

$parserFactory  = new ParserFactory;
$color          = new Color;
$color->setForceStyle(true);
$highlighter = new SyntaxHighlighter(
    $parserFactory->create(ParserFactory::PREFER_PHP7),
    new SyntaxHighlightPrinter(
        new SyntaxHighlighterConfig([
            SyntaxHighlighterConfig::TYPE_KEYWORD       => Colours::GREEN,
            SyntaxHighlighterConfig::TYPE_RETURN_NEW    => Colours::BLACK,
        ]),
        new ColorsAdapter($color)
    )
);
```

This will set any keywords as green and return & new statements as black.

## Types

Types are defined in `\PhpSchool\PSX\SyntaxHighlighterConfig` Each type can have a it's own colour.
Every keyword inside each type will be coloured by that colour.

#### TYPE_KEYWORD

 * `if`
 * `elseif`
 * `else`
 * `for`
 * `foreach`
 * `while`
 * `do`
 * `switch`
 * `finally`
 * `try`
 * `catch`
 * `break`
 * `continue`
 * `throw`
 * `goto`
 * `function`

#### TYPE_BRACE
 
 * `{`
 * `}`
 
#### TYPE_STRING

 * `'some-string'`
 
#### TYPE_CONSTRUCT

 * `echo`
 
#### TYPE_RETURN_NEW

 * `return`
 * `new`
 
#### TYPE_VAR_DEREF

 * `->`

#### TYPE_CALL_PARENTHESIS

 * `(`
 * `)`
 
