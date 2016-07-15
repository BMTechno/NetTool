<?php
SSH::into('ROUTER-NAME')->run(array(
	'/system identity'
));
SSH::run($commands, function($line)
{
    echo $line.PHP_EOL;
});