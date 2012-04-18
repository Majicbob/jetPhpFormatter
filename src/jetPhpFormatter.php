<?php
/**
 * Attempt at a PHP code formatter 
 * 
 * Using the PHP tokenizer to handle some of the hard parts 
 * that I was trying to do using Notepad++ Python Script, still should 
 * finish that up as it would be handy
 * 
 * @package  jetPhpFormatter
 * @author   John Tribolet <john@tribolet.info>
 * @version  0.0.2
 * @since    20:51 Tuesday, March 27, 2012
 * @filesource
 */

$testDir   = __DIR__ . '/tests/';
$testFile  = "$testDir/testFile.php";
$testFile2 = "$testDir/testFile2.php";
$testFile3 = "$testDir/testFile3.php";

/**
 * Gets all tokens and looks ups symbolic name when avaliable
 * @param  string  $code  PHP code to get detailed tokens from 
 * @return array   Numeric array containing assoc. array with info on each token
 */
function getDetailedTokens($code) 
{
    $tokens  = array();
    $lineNum = 0;
    $offset  = 0;
    $raw     = token_get_all($code);
    foreach ($raw as $token) {

    }
    
    return $tokens;
}

/**
 * Prints token line number, trimmed value, name and code 
 * @param array $tokens
 */
function printDetailedTokenInfo($code)
{
    $tokens = getDetailedTokens($code);
    
    foreach ($tokens as $t) {
        
        if ($t['code'] == T_WHITESPACE) {
            //continue;
        }
        
        $name = sprintf("%30s[%03d]", $t['name'], $t['code']);
        if ($t['code'] == 0) {
            $name = '';
        }
        
        printf("#%03d %03d  %03d-%03d  %5s  %s \n",  
            $t['line'], $t['length'], $t['startPos'], $t['endPos'],
            $t['trimVal'], $name);
        
  
    }
}


printDetailedTokenInfo(file_get_contents($testFile3));
