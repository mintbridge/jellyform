<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Jelly_Form_Field_Core 
 * 
 * @package Jelly
 */
abstract class Jelly_Form_Field_Core extends Jelly_Form_Element
{	
	/**
	 * @var  string  
	 */
	protected $label = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the value of an input element
	 */
	protected $value = '';
	
	/**
	 * @var  string  
	 */
	protected $_model = '';
	
	/**
	 * @var  array  
	 *
	 * Specifies the attributes view requires to be set
	 */
	protected $_required = array('name', 'value');
	
	public function model($model = NULL)
	{		
		if(is_string($model))
		{
			$this->_model = $model;
			return $this;
		}
		
		return $this->_model;
	}
}