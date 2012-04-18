<?php
/**
 * SourceDoc class unit tests 
 * 
 * @package  Tests
 * @author   John Tribolet <john@tribolet.info>
 * @filesource
 */

use jet\Formatter\SourceDoc as SourceDoc;

class SourceDocClassTest extends PHPUnit_Framework_TestCase
{
    public function testAutoloaderWorks()
    {
        $doc = new SourceDoc();
    }
    
}