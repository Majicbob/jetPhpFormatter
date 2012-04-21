<?php
/**
 * Tests for the Space After Flow Control  rule 
 * 
 * @package  Tests
 * @author   John Tribolet <john@tribolet.info>
 * @since    0.0.3
 * @filesource
 */

use jet\Formatter\SpaceAfterFlowControlRule as SpaceAfterFlowControlRule;
use jet\Formatter\Token as Token; 

class SpaceAfterFlowControlRuleTest extends PHPUnit_Framework_TestCase
{
    public function testAutoloaderWorks()
    {
        $rule = new SpaceAfterFlowControlRule();
    }
    
    public function testExtendsAbstractRule()
    {
        $rule = new SpaceAfterFlowControlRule();
        $this->assertTrue($rule instanceof jet\Formatter\AbstractRule);
    }

    
    /**
     * @dataProvider examples
     */
    public function testCheckProvidedCases($code, $expected) 
    {
        $rawTokens = token_get_all($code);
            
        $tokens = array();
        foreach ($rawTokens as $t) {
            $tokens[] = new Token($t);
        }

        $rule = new SpaceAfterFlowControlRule();
        $newTokens = $rule->apply($tokens);
        
        $result = ''; 
        foreach ($newTokens as $t) {
            $result .= $t->value;
        }
        
        $this->assertEquals($result, $expected);
    }

    public function examples()
    {
        return array(
            array(
                '<?php if(true) { if(false){echo "fail"; } echo "omg"; }',
                '<?php if (true) { if (false){echo "fail"; } echo "omg"; }'),
            array(
                '<? if($thisWorks){foreach($x as $y){while($stillWorking){for()}} ?>',
                '<? if ($thisWorks){foreach ($x as $y){while ($stillWorking){for ()}} ?>')
        );
    }
}