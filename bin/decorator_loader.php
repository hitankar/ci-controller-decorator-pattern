<?php

/**
 * CodeIgniter Application Controller Decorator Loader Class
 *
 * This class helps in setting and getting decorator classes to controllers
 *
 * @package		CodeNinja
 * @category	Hooks
 * @author		Hitankar Ray
 * @version 	1.0.0
 */
class Decorator_Loader
{
	private static $decorators = array();

	public function __destruct() {
		self::$decorators = null;
	}

	/**
	 * Public method to get mapped decorators
	 * @param CI_Controller $decoratable pass the class name of controller
	 */
	public static function getDecorators( CI_Controller $decoratable ) {
		return self::$decorators[get_class($decoratable)];
	}

	/**
	 * Public method to map decorator to controllers
	 * @param $decoratable pass the class name of controller
	 * @param $decotator pass the class name of decorator
	 */
	public static function map( $decoratable, $decorator ) {
		if (isset( self::$decorators[$decoratable] )) {
			if (!in_array($decorator, self::$decorators[$decoratable])) {
				self::$decorators[$decoratable] = array_merge(self::$decorators[$decoratable], array($decorator));
			}
		} else {
			self::$decorators[$decoratable] = array($decorator);
		}
	}

	/**
	 * Load decorator objects at runtime.
	 */
	function controller_init() {
		global $RTR; global $CI; 
		$DI = null;
		
		// Bypass this function if class has no decorator(s)
		if(!$decorators = Decorator_Loader::getDecorators($CI))
			return;
		// Iterate through the decorators
		foreach ($decorators as $decorator) {
			// Following Codeigniter practice to use lowercase filenames
			$file = APPPATH. DECORATORPATH . '/'.$RTR->fetch_directory(). strtolower($decorator) .'.php';
			if ( ! file_exists($file)) {
				show_error("Unable to load decorator {$decorator} for controller. Make sure the file exists or properly loaded.");
			} else {
				// Load decorator class and inherit in runtime
				require_once $file;
				if (null == $DI) {
					$DI = new $decorator($CI);
				} else {
					$DI = new $decorator($DI);
				}
			}
		}
		$CI = $DI;
	}
}