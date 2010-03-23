<?php defined('SYSPATH') or die('No direct script access.');

class Jelly_Form_Field_Input extends Jelly_Form_Field {
	
	/**
	 * @var  string  
	 *
	 * Specifies a keyboard shortcut to access an element
	 */
	protected $accesskey = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the types of files that can be submitted through a file upload (only for type="file")
	 */
	protected $accept = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies an alternate text for an image input (only for type="image")
	 */
	protected $alt = '';
	
	/**
	 * @var  string 
	 *
	 * Specifies that an input element should be preselected when the page loads (for type="checkbox" or type="radio")
	 */
	protected $checked = '';
	
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
	 * Specifies the maximum length (in characters) of an input field (for type="text" or type="password")
	 */
	protected $maxlength = '';
	
	/**
	 * @var  string 
	 *
	 * Specifies that an input field should be read-only (for type="text" or type="password") 
	 */
	protected $readonly = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the width of an input field
	 */
	protected $size = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the URL to an image to display as a submit button
	 */
	protected $src = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the tab order of an element
	 */
	protected $tabindex = '';
	
	/**
	 * @var  string 
	 *
	 * Specifies the type of an input element
	 */
	protected $type = array('text', 'button', 'checkbox', 'file', 'hidden', 'image', 'password', 'radio', 'reset', 'submit');
	
	/**
	 * @var  string  
	 *
	 * Name of the view to be rendered
	 */
	protected $_view = 'jelly/form/field/input';
	
	/**
	 * @var  array  
	 *
	 * Specifies the value of an input element
	 */
	protected $_required = array('type' ,'name', 'value', 'label');

}