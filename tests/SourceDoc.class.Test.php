<?php
/**
 * SourceDoc class unit tests 
 * 
 * @package  Tests
 * @author   John Tribolet <john@tribolet.info>
 * @filesource
 */

use jet\Formatter\SourceDoc as SourceDoc;

class SourceDocClassTest extends PHPUnit_Framework_TestCase
{
    public function testAutoloaderWorks()
    {
        $doc = new SourceDoc();
    }
    
    public function testParseFileNumOfTokensMatches()
    {
        $file = __DIR__ . '/testFile3.php';
        $doc = new SourceDoc(); 
        $doc->parseFile($file);
        $numTokenObjects = $doc->numOfTokens();
        
        $code         = file_get_contents($file);
        $rawTokens    = token_get_all($code);
        $numRawTokens = count($rawTokens);
        
        $this->assertEquals($numRawTokens, $numTokenObjects);
    }
}