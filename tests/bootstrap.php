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
    //echo "\n Autoloading $name \n";
    $name = str_replace('jet\Formatter\\', '', $name);
    $file = __DIR__ . "/../src/classes/$name.class.php";
    
    if (is_file($file)) {
        include $file;
    }
    else {
        echo "\n $file \n";
    }
}
spl_autoload_register('testingAutoLoader');
