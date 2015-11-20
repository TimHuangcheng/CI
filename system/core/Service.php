<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/17
 * Time: 17:39
 */
class CI_Service {

	/**
     * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Service Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Service.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}

}
