<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	var $actsAs = array('Containable', 'DatetimeFormatter');
	
	/** 
	* checks is the field value is unqiue in the table 
	* note: we are overriding the default cakephp isUnique test as the original appears to be broken 
	* 
	* @param string $data Unused ($this->data is used instead) 
	* @param mnixed $fields field name (or array of field names) to validate 
	* @return boolean true if combination of fields is unique 
	*/ 
	function checkUnique($data, $fields) { 
		if (!is_array($fields)) { 
			$fields = array($fields); 
		} 
		foreach($fields as $key) { 
			$tmp[$key] = $this->data[$this->name][$key]; 
		} 
		if (isset($this->data[$this->name][$this->primaryKey])) { 
			$tmp[$this->primaryKey] = "<>".$this->data[$this->name][$this->primaryKey];
		} 
		return $this->isUnique($tmp, false);
	}
	
	public function removeKeysRecursive($array, $unwanted, $strict=true) {
		foreach ($array as $key => $value) {
			if (in_array($key, $unwanted, $strict)) {
				unset($array[$key]);
			}
			if (is_array($value)) {
				$array[$key] = $this->removeKeysRecursive($value, $unwanted);
			}
		}
		return $array;
	}
	
	public function replaceKeysRecursive($array, $replace, $with) {
		foreach ($array as $key => $value) {
			if (in_array($key, $replace)) {
				$found_key = array_search($key, $replace);
				$array[$key] = $with[$found_key];
			}
			if (is_array($value)) {
				$array[$key] = $this->replaceKeysRecursive($value, $replace, $with);
			}
		}
		return $array;
	}
	
	public function replaceValuesRecursive($array, $whenkey, $replace, $with) {
		foreach ($array as $key => $value) {
			if ($key==$whenkey && in_array($value, $replace)) {
				$found_key = array_search($value, $replace);
				$array[$key] = $with[$found_key];
			}
			if (is_array($value)) {
				$array[$key] = $this->replaceValuesRecursive($array, $whenkey, $replace, $with);
			}
		}
		return $array;
	}
}
