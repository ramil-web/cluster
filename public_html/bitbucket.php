<?php
$output = array();
exec('cd ..', $output);
exec('git pull 2>&1', $output);
foreach($output as $line) {
    echo $line . "\r\n";
}
die();