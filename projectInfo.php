<?php
/**
 * Calculates project code stats and displays as webpage
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
        $results[] = outputFromCommand($cmd);
    }
    return $results;
}

$results = getAllResults();

?>

<html>
  <head>
    <style>
        body {
            background-color:#6699ff;
        }
        div {
            background-color:#ffebd4;
            border:1px solid black;
            margin: 25px 10px;
            overflow:auto;
            padding:2px 10px;
        }
    </style>
  </head>
  
  <body>
  
    <?php foreach ($results as $result) { ?>
        <div>
            <pre><?php echo $result; ?></pre>
        </div>
    <?php } ?>
    
  </body>
</html>

<?php phpinfo(); ?>

