<?php
/**
 * Defines and registers the autoloader used during automated testing 
 *  
 * @see         spl_autoload_register
 * @package     Tests
 * @author      John Tribolet <john@tribolet.info>
 * @copyright   John Tribolet
 * @since       v0.1
 * @filesource
 */

function testingAutoloader($name) 
{
    //echo "\n $name \n";
    $name = str_replace('jet\Formatter\\', '', $name);
    $file = __DIR__ . "/../$name.class.php";
    
    if (is_file($file)) {
        //echo "\n $file \n";
        include $file;
    }    
}
spl_autoload_register('testingAutoLoader');
