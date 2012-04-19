<?php
/**
 * No Whitespace Rule
 *
 * A test implementation of a rule. Removes all whitespace. 
 * 
 * @package  jetPhpFormatter
 * @author   John Tribolet <john@tribolet.info>
 * @version  0.0.2
 * @since    00:07 Thursday, April 19, 2012
 * @filesource
 */


namespace jet\Formatter;

class NoWhitespaceRule extends AbstractRule
{
    /**
     * @var string Friendly short name
     */
    public $name = 'No Whitespace';

    /**
     * @var string Description of the rule
     */
    public $description = 'Removes all whitespace from the code';

    /**
     * Takes an array of Tokens and applys the rule 
     * 
     * @returns array Tokens with rule applied 
     */
    public function apply($tokens) 
    {
        $newTokens = array();
        foreach ($tokens as $t) {
            if ($t->isWhitespace()) {
                continue; 
            }
            $newTokens[] = $t;
        }
        
        return $newTokens; 
    }
    
}