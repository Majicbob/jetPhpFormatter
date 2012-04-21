<?php
/**
 * Space Around Operators Rule
 *
 * Makes sure there is a space around operators.
 * If an operator other than :: , -> , ++ , -- is found add space before and after.
 * Then backtrack and drop any extra spacing. 
 * 
 * @package    jetPhpFormatter
 * @subpackage Rules
 * @author     John Tribolet <john@tribolet.info>
 * @version    0.0.3
 * @since      0.0.3
 * @filesource
 */


namespace jet\Formatter;

class SpaceAroundOperatorsRule extends AbstractRule
{
    /**
     * @var string Friendly short name
     */
    public $name = 'Space Around Operators';

    /**
     * @var string Description of the rule
     */
    public $description = 'Makes sure there is a space around operators';

    /**
     * Takes an array of Tokens and applys the rule 
     * 
     * @returns array Tokens with rule applied 
     */
    public function apply($tokens) 
    {
        $newTokens = array();
        $inProgress = true; 
        
        for ($i = 0; $i < count($tokens); $i++) {
            $t = $tokens[$i];
            if ($this->isTargetToken($t)) {
                $inProgress = true; 
                $this->checkPrevious($tokens, $i, $newTokens);
                
                $space = new Token(' ');
                $newTokens[] = $space; 
                $newTokens[] = $t; 
                $newTokens[] = $space; 
                continue;
            }
            
            if ($inProgress) {
                if ($t->isWhitespace()) {
                    continue;
                }
                else {
                    // check for right side here? 
                    $inProgress = false;
                }
            }
            
            $newTokens[] = $t; 
        }
        
        return $newTokens; 
    }
    
    protected function checkPrevious(&$tokens, $i, &$newTokens)
    {
        $i--;
        $prevToken = $tokens[$i];
        if ($prevToken->isWhitespace()) {
            array_pop($newTokens);
            $this->checkPrevious($tokens, $i, $newTokens);
        }
    }
    
    protected function isTargetToken(Token $token)
    {
        $applyTo = array(
            T_BOOLEAN_AND, 
            T_BOOLEAN_OR, 
            T_CONCAT_EQUAL, 
            T_DOUBLE_ARROW,
            T_DIV_EQUAL,
            T_IS_EQUAL,
            T_IS_GREATER_OR_EQUAL,
            T_IS_IDENTICAL,
            T_IS_NOT_EQUAL,
            T_IS_NOT_IDENTICAL,
            T_IS_SMALLER_OR_EQUAL,
            T_LOGICAL_AND,
            T_LOGICAL_OR,
            T_LOGICAL_XOR,
            T_MINUS_EQUAL,
            T_MOD_EQUAL,
            T_MUL_EQUAL,
            T_OR_EQUAL,
            T_PLUS_EQUAL,
            T_SL,
            T_SL_EQUAL,
            T_SR,
            T_SR_EQUAL
        );
        return in_array($token->code, $applyTo);
    }
}