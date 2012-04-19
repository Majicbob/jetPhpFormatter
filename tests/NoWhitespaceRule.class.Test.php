<?php
/**
 * Tests for the no whitespace rule 
 * 
 * @package  Tests
 * @author   John Tribolet <john@tribolet.info>
 * @filesource
 */

use jet\Formatter\NoWhitespaceRule as NoWhitespaceRule;
use jet\Formatter\SourceDoc as SourceDoc; 
use jet\Formatter\Token as Token; 

class NoWhitespaceRuleClassTest extends PHPUnit_Framework_TestCase
{
    public function testAutoloaderWorks()
    {
        $rule = new NoWhitespaceRule();
    }

    public function testRuleRemovesWhitespace()
    {
        $rawTokens = token_get_all('
            <?php

            namespace jet;

            class smallClass 
            { 
                echo "
                    <div>
                        asdf
                    </div>";
            } ');
            
        $tokens = array();
        foreach ($rawTokens as $t) {
            $tokens[] = new Token($t);
        }

        $rule = new NoWhitespaceRule();
        $newTokens = $rule->apply($tokens);
        
        foreach ($newTokens as $t) {
            $this->assertFalse($t->isWhitespace());
        }
        
    }
}