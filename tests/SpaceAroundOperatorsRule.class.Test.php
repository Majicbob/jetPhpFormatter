<?php
/**
 * Tests for the Space After Flow Control  rule 
 * 
 * @package  Tests
 * @author   John Tribolet <john@tribolet.info>
 * @since    0.0.3
 * @filesource
 */

use jet\Formatter\SpaceAroundOperatorsRule as SpaceAroundOperatorsRule;
use jet\Formatter\Token as Token; 

class SpaceAroundOperatorsRuleTest extends PHPUnit_Framework_TestCase
{
    public function testAutoloaderWorks()
    {
        $rule = new SpaceAroundOperatorsRule();
    }
    
    public function testExtendsAbstractRule()
    {
        $rule = new SpaceAroundOperatorsRule();
        $this->assertTrue($rule instanceof jet\Formatter\AbstractRule);
    }

    
    /**
     * @dataProvider examples
     */
    public function testCheckProvidedCases($code, $expected) 
    {
        echo "\n using $code";
        $rawTokens = token_get_all($code);
            
        $tokens = array();
        foreach ($rawTokens as $t) {
            $tokens[] = new Token($t);
        }

        $rule = new SpaceAroundOperatorsRule();
        $newTokens = $rule->apply($tokens);
        
        $result = ''; 
        foreach ($newTokens as $t) {
            $result .= $t->value;
        }
        echo "\nresult $result";
        echo "\nexpect $expected\n";
        $this->assertEquals($expected, $result);
    }

    public function examples()
    {
        return array(
            array(
                '<?php if(1==1&&2!=3) { }',
                '<?php if(1 == 1 && 2 != 3) { }' ),
            array(
                '<?php if(1==1) { }',
                '<?php if(1 == 1) { }' ),
            array(
                '<?php if(1   &&   1) {  }',
                '<?php if(1 && 1) {  }' )
            
        );
    }
}