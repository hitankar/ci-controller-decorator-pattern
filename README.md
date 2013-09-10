## Synopsis

Controller Decorator Module to bring Decorator Pattern to controllers in CodeIgniter. You can now inherit functionalities in runtime. Maintain Single Responsibility and DRY principles by accessing common methods, etc. 

## Code Example

Create decorators:
```php
class Test_Decorator extends Controller_Decorator {
	
	function .... {

	}
}
```
Map them to controllers
```php
Decorator_Loader::map('Welcome','Test_Decorator');
```

## Motivation

In large applications, CodeIgniter controllers can have a large unmaintainable set of methods. Some methods are repeated among different controller. I wanted a way that handles such issue.

## Installation

Git clone the files to a folder (decorators by default) under the application folder.

Enable hooks by setting it to TRUE in config/config.php
```php
$config['enable_hooks'] = TRUE;
```
Add the following code in config/hooks.php (Default filepath is decorators. If you have used different path, specify under filepath)
```php
$hook['pre_controller'] = array(
	'function' => 'decorator_config',
	'filename' => 'config.php',
	'filepath' => 'decorators'
);

$hook['post_controller_constructor'] = array(
	'class'    => 'Decorator_Loader',
	'function' => 'controller_init',
	'filename' => 'decorator_loader.php',
	'filepath' => 'decorators'. DIRECTORY_SEPARATOR . 'bin'
);
```

Create Decorators for Controllers (default location is decorators)
```php
class Test_Decorator extends Controller_Decorator {
	
	function .... {

	}
}
```
If you have used a different location to place your Decorator classes. Please specify in decorators/config.php
```php
define('DECORATORPATH', 'decorators');
```

Map your decorators to controllers by adding an entry within decorator_config() method in decorators/config.php
```php
function decorator_config() {
	Decorator_Loader::map('Welcome','Test_Decorator');
	// add more maps
}
```


## License
GLP2