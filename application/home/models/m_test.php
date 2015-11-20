<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @category	Models
 * @author		tim
 * @link
 *
 *
 */
class M_test extends Model_basemodel{
	public function __construct() {
		parent::__construct();
	}
    protected function setTableName() {
        $this->_tableName = "test";
        // TODO: Implement setTableName() method.
    }
}
