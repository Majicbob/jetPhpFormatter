<?php
/**
 * Space After Flow Control 
 *
 * Makes sure there is a space after flow control constructs: 
 * if, foreach, for while 
 * 
 * @package    jetPhpFormatter
 * @subpackage Rules
 * @author     John Tribolet <john@tribolet.info>
 * @version    0.0.3
 * @since      06:07 Saturday, April 21, 2012
 * @filesource
 */


namespace jet\Formatter;

class SpaceAfterFlowControlRule extends AbstractRule
{
    /**
     * @var string Friendly short name
     */
    public $name = 'Space After Flow Control';

    /**
     * @var string Description of the rule
     */
    public $description = "
        Makes sure there is a space after flow control constructs:
        if, foreach, while ";

    /**
     * Takes an array of Tokens and applys the rule 
     * 
     * @returns array Tokens with rule applied 
     */
    public function apply($tokens) 
    {
        $newTokens = array();
        
        $inProgress = false; 
        foreach ($tokens as $t) {
            if ($this->isTargetToken($t)) {
                $inProgress = true;
                $newTokens[] = $t; 
                
                $space = new Token(' ');
                $newTokens[] = $space; 
                continue;
            }
            
            if ($inProgress) {
                if ($t->isWhitespace()) {
                    continue;
                }
                else {
                    $inProgress = false;
                }
            }
            $newTokens[] = $t;
        }
        
        return $newTokens; 
    }
    
    protected function isTargetToken(Token $token)
    {
        $applyTo = array(T_IF, T_FOR, T_FOREACH, T_WHILE);
        return in_array($token->code, $applyTo);
    }
}