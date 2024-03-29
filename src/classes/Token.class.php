<?php
/**
 * Detailed Token Class
 *
 * Class describing a PHP language token with detailed information
 * about its lengh, location, and type. Used for knowing where to
 * apply whitespace changes for during format/style.
 *
 * @package  jetPhpFormatter
 * @author   John Tribolet <john@tribolet.info>
 * @link     http://php.net/manual/en/tokens.php
 * @version  0.0.2
 * @since    00:37 Wednesday, March 28, 2012
 * @filesource
 */

namespace jet\Formatter;

class Token
{
    /**
     * @var string Symbolic name
     */
    public $name;

    /**
     * @var int
     */
    public $code;

    public $value;
    public $length;
    public $startPos;
    public $endPos;
    public $lineNum;

    public function __construct($tokenInfo, $offset = 0)
    {
        $this->code     = 0;
        $this->name     = 'Single Symbol';
        $this->startPos = $offset + 1;
        //$new['trimVal']  = $new['value'] = $token;

        if (is_array($tokenInfo)) {
            $this->code    = (int)$tokenInfo[0];
            $this->name    = token_name($this->code);
            $this->value   = $tokenInfo[1];
            $this->lineNum = $tokenInfo[2];
        }
        else {
            // token_get_all creates arrays for all except some single char tokens
            // like braces, brakets, parens
            $this->value = $tokenInfo; 
        }

        $this->length = strlen($this->value);
        $this->endPos = $offset + $this->length;
    }
    
    public function __toString()
    {
        $name = sprintf("%s", $this->name, $this->code);


        return sprintf("
                #%03d %03d  %03d-%03d  %26s  %s",
                $this->lineNum, $this->length, 
                $this->startPos, $this->endPos,
                $this->trimVal(), $name);
    }

    public function trimVal()
    {
        $noDisplay   = array("\r", "\n", "\t");
        $replaceWith = array('\r', '\n', '\t');
        $shorten     = substr($this->value, 0, 25);
        return str_replace($noDisplay, $replaceWith, $shorten);
    }
    
    public function isWhitespace()
    {
        return ($this->code == T_WHITESPACE);
    }


}