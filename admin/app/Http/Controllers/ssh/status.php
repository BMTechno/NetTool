<?php
SSH::into('ROUTER-NAME')->run(array(
	'ip address print'
));
SSH::run($commands, function($line)
{
    echo $line.PHP_EOL;
});