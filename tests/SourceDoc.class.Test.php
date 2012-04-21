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
    
    public function testAddRule()
    {
        $doc = $this->getSourceDocWithNoWhitespaceRule();
        $addedRule = $doc->rules[0];
        $this->assertTrue($addedRule instanceof jet\Formatter\AbstractRule);
    }
    
    public function testApplyRulesUsingNoWhitespaceRule()
    {
        $doc = $this->getSourceDocWithNoWhitespaceRule();
        $file = __DIR__ . '/testFile3.php';
        $doc->parseFile($file); 
        
        $doc->applyRules();
        $newTokens = $doc->getNewTokens();
        
        $numOldTokens = count($doc->getOrigTokens());
        $numNewTokens = count($doc->getNewTokens()); 
        
        $this->assertTrue($numOldTokens > $numNewTokens);
    }
    
    public function testWriteNewFileWithAppliedRule()
    {
        $doc = $this->getSourceDocWithNoWhitespaceRule();
        $file = __DIR__ . '/testFile3.php';
        $doc->parseFile($file);
        $doc->applyRules(); 
        
        $newFile = __DIR__ . '/testFile3.new.php';
        $doc->writeNewFile($newFile);
        
        $newFileContents = file_get_contents($newFile);
        $testCaseContents = file_get_contents(__DIR__ . '/testFile3.NoWhitespaceRule.php');
        
        $this->assertEquals($newFileContents, $testCaseContents); 
        unlink($newFile);
        
    }
    
    protected function getSourceDocWithNoWhitespaceRule()
    {
        $doc = new SourceDoc();
        $rule = new jet\Formatter\NoWhitespaceRule();
        $doc->addRule($rule);
        return $doc;
    }
}