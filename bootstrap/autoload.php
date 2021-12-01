<?php
// We autoload all classesfor dependency management. This allows us to find all classes withing our project
// The function is responsible for wiring up how other classes know of each other without having to resort to requires and includes.
function autoloader($className) {
	$fileName = str_replace('\\', '/', $className) . '.php';
	
	include __DIR__ . '/../app/' . $fileName;
}

spl_autoload_register('autoloader');