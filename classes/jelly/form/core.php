<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Jelly_Form_Core 
 * 
 * @package Jelly
 */
abstract class Jelly_Form_Core extends Jelly_Form_Element
{
	/**
	 * @var  string URL
	 *
	 * Specifies where to send the form-data when a form is submitted
	 */
	protected $action = '';
	
	/**
	 * @var  string MIME_type 
	 *
	 * Specifies the types of files that can be submitted through a file upload
	 */
	protected $accept = '';
	
	/**
	 * @var  string charset
	 *
	 * Specifies the character-sets the server can handle for form-data
	 */
	protected $accept_charset = '';
	
	/**
	 * @var  string   
	 *
	 * Specifies how form-data should be encoded before sending it to a server
	 */
	protected $enctype = array('text/plain',
							   'application/x-www-form-urlencoded', 
							   'multipart/form-data');
	
	/**
	 * @var  string Form method  
	 *
	 * Specifies how to send form-data
	 */
	protected $method = array('GET', 'POST') ;
	
	/**
	 * @var  string name  
	 *
	 * Specifies the name for a form
	 */
	protected $name = '';
	
	/**
	 * @var  array  
	 */
	protected $elements = array();
	
	/**
	 * @var  array  
	 */
	protected $_view = 'jelly/form';
	
	/**
	 * @var  array  
	 */
	protected $_required = array('action', 'elements');
	
	/**
	 * Elements
	 *
	 * To do
	 *
	 * @param   mixed  $element  
	 * @return  mixed
	 */
	public function elements($element = NULL)
	{
		if (is_array($element))
		{
			$this->elements += $element;
			return $this;
		}
		
		if(is_string($element))
		{
			if(array_key_exists($element, $this->elements))
			{
				return $this->elements[$element];
			}
			return array();
		}
		
		return $this->elements;
	}
	
	/**
	 * Remove
	 *
	 * Remove elements from the elements array 
	 *
	 * @param   mixed  $name  The field's name
	 * @return  mixed
	 */
	public function remove($elements = NULL)
	{
		if(is_array($elements))
		{
			foreach($elements as $element)
			{
				$this->remove($element);
			}
		}
		if(is_string($elements))
		{
			if(array_key_exists($elements, $this->elements))
			{
				unset($this->elements[$elements]);
			}
		}
		return $this;
	}
}