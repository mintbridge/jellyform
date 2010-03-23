<?php defined('SYSPATH') or die('No direct script access.');

class Jelly_Form_Field_Timestamp extends Jelly_Form_Input
{
	/**
	 * @var  string 
	 *
	 * Specifies the format to display the timestamp
	 */
	protected $pretty_format = 'd/m/Y';
	
	/**
	 * @var  string 
	 *
	 * Specifies the type of an input element
	 */
	protected $type = 'text';
	
	/**
	 * @var  string  
	 *
	 * Name of the view to be rendered
	 */
	protected $_view = 'jelly/form/field/timestamp';
	
	/**
	 * @var  array  
	 *
	 * Specifies the value of an input element
	 */
	protected $_required = array('type' ,'name', 'value', 'label', 'pretty_format');
}