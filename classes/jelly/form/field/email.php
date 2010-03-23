<?php defined('SYSPATH') or die('No direct script access.');

abstract class Jelly_Form_Field_Email extends Jelly_Form_Input {
	
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
	protected $_view = 'jelly/form/field/email';
	
}