<?php
/**
 * Calculates project code stats and displays as webpage
 */ 

function phpcpd()
{   
    $cpd;
    exec('phpcpd src/', $cpd);

    $phpcpdResults = '';
    foreach ($cpd as $line) {
        $phpcpdResults .= "$line \n";
    }
    
    echo $phpcpdResults;
}

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
            margin:0 50px 10px 10px;
            overflow:auto;
            padding:2px 10px;
        }
    </style>
  </head>
  
  <body>
    <div>
        <pre><?php phpcpd(); ?></pre>
    </div>
  </body>
</html>