<?php
/**
 * Source Document Class
 *
 * Class representing a PHP document with source tokens
 *
 * @package  jetPhpFormatter
 * @author   John Tribolet <john@tribolet.info>
 * @version  0.0.3
 * @since    02:21 Wednesday, April 18, 2012
 * @filesource
 */

namespace jet\Formatter;

class SourceDoc
{
    /**
     * @var string Document name
     */
    public $name;
    
    /**
     * @var array Of Rules classes
     */
    public $rules;

    /**
     * @var array Array of Token objects
     */
    protected $tokens;
    
    /**
     * @var array Array of Token objects, applying rules return here 
     */
    protected $newTokens;

    /**
     * Reads given file and populates $tokens
     *
     * @param string  filePath Path to file for parsing
     */
    public function parseFile($filePath)
    {
        $code         = file_get_contents($filePath);
        $this->tokens = $this->getTokens($code);
    }
    
    /**
     * Reads given string and populates $tokens
     *
     * @param string code
     */
    public function parseString($code)
    {
        $this->tokens = $this->getTokens($code);
    }
    
    public function newTokensToString()
    {
        $newDoc = '';
        foreach ($this->newTokens as $t) {
            $newDoc .= $t->value;            
        }
        return $newDoc;
    }
    
    /**
     * Writes out $this->newTokens to file
     */
    public function writeNewFile($filePath)
    {
        $newDoc = $this->newTokensToString();
        file_put_contents($filePath, $newDoc); 
    }

    /**
     * @return int Number of parsed tokens
     */
    public function numOfTokens()
    {
        return count($this->tokens);
    }

    /**
     * Prints token line number, trimmed value, name and code
     */
    public function printTokenInfo()
    {
        foreach ($this->tokens as $t) {
            echo $t;
        }
    }

    /**
     * Add new rule 
     * 
     * @todo Pull out to RuleManger or something
     */
    public function addRule(AbstractRule $rule)
    {
        $this->rules[] = $rule;
    }
    
    public function applyRules()
    {
        $this->newTokens = $this->tokens; 
        foreach ($this->rules as $rule) {
            $this->newTokens = $rule->apply($this->newTokens);
        }
    }
    
    public function getNewTokens()
    {
        return $this->newTokens;
    }
    
    public function getOrigTokens()
    {
        return $this->tokens;
    }
    
    /**
     * Gets all tokens and looks ups symbolic name when avaliable
     * 
     * @param  string  $code  PHP code to get detailed tokens from
     * @return array   Array of Token objects
     * @todo Move to token class or token manager class? 
     */
    protected function getTokens($code)
    {
        $offset = 0;
        $raw    = token_get_all($code);

        $tokens = array();
        foreach ($raw as $token) {
            $t        = new Token($token, $offset);
            $offset   = $t->endPos;
            $tokens[] = $t;
        }

        return $tokens;
    }

}