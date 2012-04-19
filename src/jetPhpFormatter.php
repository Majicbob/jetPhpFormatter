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

namespace jet\Formatter;

require_once(__DIR__ . '/../tests/bootstrap.php');

$testDir   = __DIR__ . '/../tests';
$testFile  = "$testDir/testFile.php";
$testFile2 = "$testDir/testFile2.php";
$testFile3 = "$testDir/testFile3.php";

$doc = new SourceDoc();
$doc->parseFile($testFile3);
$doc->printTokenInfo();
