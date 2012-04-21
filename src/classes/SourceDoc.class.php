<?php
/**
 * Source Document Class
 *
 * Class representing a PHP document with source tokens
 *
 * @package  jetPhpFormatter
 * @author   John Tribolet <john@tribolet.info>
 * @version  0.0.2
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
    
    public $rules;

    /**
     * @var array Array of Token objects
     */
    protected $tokens;

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
     * @return int Number of parsed tokens
     */
    public function numOfTokens()
    {
        return count($this->tokens);
    }

    /**
     * Prints token line number, trimmed value, name and code
     */
    function printTokenInfo()
    {
        foreach ($this->tokens as $t) {
            echo $t;
        }
    }

    /**
     * Gets all tokens and looks ups symbolic name when avaliable
     * @param  string  $code  PHP code to get detailed tokens from
     * @return array   Array of Token objects
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