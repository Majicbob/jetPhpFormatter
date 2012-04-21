<?php
/**
 * Calculates project code stats and displays as webpage
 * 
 */ 

function outputFromCommand($cmd)
{   
    $output;
    exec($cmd, $output);

    $results = '';
    foreach ($output as $line) {
        $results .= "$line \n";
    }
    
    return $results;
}

function getAllResults()
{
    $commands = array(
        'phpunit --testdox -c tests/phpunit.xml tests', 
        'phploc src/',
        'phpcpd src/',
        'phpcs src/ --report-width=110 --standard=Sebastian'
    );
    $results = array();
    foreach ($commands as $cmd) {
        $results[] = array('txt' => outputFromCommand($cmd));
    }
    
    // check for failed tests 
    $failed = preg_match('"\[ ]"', $results[0]['txt']);
    $results[0]['class'] = ($failed) ? 'failed' : 'passed'; 
    return $results;
}

$results = getAllResults();

?>

<html>
  <head>
    <title>jetPhpFormatter Project Info</title>
    <link rel="stylesheet" type="text/css" href="jetPhpFormatter.css" />
  </head>
  
  <body>
  
    <?php foreach ($results as $result) { ?>
        <div class="<?php echo $result['class']; ?>">
            <pre><?php echo $result['txt']; ?></pre>
        </div>
    <?php } ?>
    
  </body>
</html>

<?php phpinfo(); ?>

