<?php
//Lviv airport: 41644

require_once('Search.php');
ini_set('max_execution_time', '0');
echo '<html lang="en">
        <head>
            <style>
                body {
                      background-color: #262525;
                      color: #9fccff;
                      }
                table {
                       border: #9fccff;
                }
            </style>
            <title>Diploma</title>
        </head>
        <body>';

try {
    $dfs = new Search();
    $dfs->findCycles(41644,41644);
    $dfs->unsetStack();
}
catch(PDOException $exception) {
    echo $exception->getMessage();
}

echo '</body></html>';


