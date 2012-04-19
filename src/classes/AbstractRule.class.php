<?php
/**
 * Abstract Rule Class 
 *
 * Provides the basic setup for a formatting rule 
 *
 * @package  jetPhpFormatter
 * @author   John Tribolet <john@tribolet.info>
 * @version  0.0.2
 * @since    22:04 Wednesday, April 18, 2012
 * @filesource
 */


namespace jet\Formatter;

abstract class AbstractRule
{
    /**
     * @var string Friendly short name
     */
    public $name;

    /**
     * @var string Description of the rule
     */
    public $description;

    /**
     * Takes an array of Tokens and applys the rule 
     * 
     * @returns array Tokens with rule applied 
     */
    abstract public function apply($tokens);
    
}