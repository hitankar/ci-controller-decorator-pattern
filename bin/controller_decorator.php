<?php

/**
 * CodeIgniter Application Decorator Class
 *
 * This abstract class will allow controller inheritence at runtime.
 *
 * @package		CodeNinja
 * @category	Hooks
 * @author		Hitankar Ray
 * @version 	1.0.0
 */
abstract class Controller_Decorator extends CI_Controller {
	protected $_decorated;

	/**
	 * @param Controller_Decorator $decorated Pass the object to decorate
	 */
	public function __construct(Controller_Decorator $decoratable) {
		$this->_decorated = $decoratable;
	}

	/**
	 * Public method to access decorated property
	 */
	public function get_decorated() {
		return $this->_decorated;
	}

	/**
	 * Public method to access methods of decorated class
	 */
	public function __call($method, $params) {
		return $this->_decorated->$method($params);
	}

	/**
	 * Remap incoming method calls to use __call magic methods
	 */
	public function _remap($method, $params = array()) {
		return $this->$method($params);
    }

}