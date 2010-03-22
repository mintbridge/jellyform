<?php defined('SYSPATH') or die('No direct script access.');

class Jelly_Form_Field_Text extends Jelly_Form_Field {
	 
	/**
	 * @var  string  
	 *
	 * Specifies a keyboard shortcut to access an element
	 */
	protected $accesskey = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the visible width of a text-area
	 */
	protected $cols = '';
	
	/**
	 * @var  string  
	 * 
	 * Specifies that a text-area should be disabled
	 */
	protected $disabled = '';
	
	/**
	 * @var  string  
	 * 
	 * Specifies that a text-area should be read-only
	 */
	protected $readonly = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the visible number of rows in a text-area
	 */
	protected $rows = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the tab order of an element
	 */
	protected $tabindex = '';
	
	/**
	 * @var  string  
	 */
	protected $_view = 'jelly/form/field/text';
	
	/**
	 * @var  array  
	 */
	protected $_required = array('name', 'value', 'label');

}