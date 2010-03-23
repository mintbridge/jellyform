<?php defined('SYSPATH') or die('No direct script access.');

abstract class Jelly_Form_Field_Select extends Jelly_Form_Field {
	
	/**
	 * @var  string  
	 *
	 * Specifies a keyboard shortcut to access an element
	 */
	protected $options = array();
	
	/**
	 * @var  string  
	 *
	 * Specifies a keyboard shortcut to access an element
	 */
	protected $accesskey = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies that an input element should be disabled when the page loads
	 */
	protected $disabled = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies a language code for the content in an element
	 */
	protected $lang = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies that multiple options can be selected
	 */
	protected $muliple = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the width of an input field
	 */
	protected $size = '';
	
	/**
	 * @var  string  
	 *
	 * Name of the view to be rendered
	 */
	protected $_view = 'jelly/form/field/select';
	
	/**
	 * @var  array  
	 *
	 * Specifies the value of an input element
	 */
	protected $_required = array('name', 'value', 'label', 'options');

}