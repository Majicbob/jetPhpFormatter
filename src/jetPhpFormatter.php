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

function showPreview($file)
{
    $doc = new SourceDoc();
    $doc->parseFile($file);
    $doc->rules[] = new SpaceAroundOperatorsRule();
    $doc->rules[] = new SpaceAfterFlowControlRule();
    $doc->applyRules();
    $formatted = htmlentities($doc->newTokensToString());
    $original  = htmlentities(file_get_contents($file));
    return array('a' => $original, 'b' => $formatted);
}

$results = showPreview($testFile);
$before  = $results['a'];
$after   = $results['b'];


?>

<html>
  <head>
    <title>jetPhpFormatter - Preview</title>
    <link rel="stylesheet" type="text/css" href="/jetPhpFormatter/jetPhpFormatter.css" />
  </head>
  
  <body>
    <div class="right">
        <h3>After</h3>
        <hr />
        <pre><?php echo $after; ?></pre>
    </div>
    <div class="left">
        <h3>Before</h3>
        <hr />
        <pre><?php echo $before; ?></pre>
    </div>
    
    
    
  </body>
</html>
