<?php

/*
 * Loads the required class. Not using namespaces, because CodeIgniter doesn't use them
 */
require_once 'bin/controller_decorator.php';
require_once 'bin/decorator_loader.php';

/*
 * Sets the path
 */
define('DECORATORPATH', 'decorators');

/**
 * Method to map controller to decorator. The order of mapping is from top to bottom
 */
function decorator_config() {
	// Decorator_Loader::map('Welcome','Test_Decorator');
}