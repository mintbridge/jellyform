<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Jelly_Form_Field_Core 
 * 
 * @package Jelly
 */
abstract class Jelly_Form_Field_Core
{
	/**
	 * @var  string  
	 */
	private $id = '';
	
	/**
	 * @var  string  
	 */
	private $name = '';
	
	/**
	 * @var  string  
	 */
	private $label = '';
	
	/**
	 * @var  string  
	 */
	private $value = '';
	
	/**
	 * @var  string  
	 */
	private $type = '';
	
	/**
	 * @var  array  
	 */
	private $_properties = array();
	
	/**
	 * @var  string  
	 */
	private $class = '';
	
	/**
	 * @var  array  
	 */
	private $attributes = array();
	
	/**
	 * @var  string  
	 */
	private $_view = 'form/field';
	
	/**
	 * Constructor.
	 *
	 * To do
	 *
	 * @param  array  $values
	 **/
	public function __construct(array $properties = NULL)
	{
		$this->_properties = (array) get_object_vars($this);
		if(is_array($properties))
		{
			foreach($properties as $key => $value)
			{
				if(strpos($key,'_') !== 0)
				{
					$this->set($key, $value);
				}
			}
		}
	}
	
	/**
	 * Returns field values as members of the object.
	 *
	 * Under the hood, this is just calling get()
	 *
	 * @see     get()
	 * @param   string  $name
	 * @return  mixed
	 */
	public function __get($name)
	{	
		return $this->get($name);
	}

	/**
	 * To string
	 *
	 * To do
	 *
	 * @see     render()
	 * @return  string
	 */
	public function __toString()
	{	
		return $this->render();
	}
	
	/**
	 * Allows members to be set on the object.
	 *
	 * Under the hood, this is just calling set()
	 *
	 * @see     set()
	 * @param   string  $name
	 * @param   mixed   $value
	 * @return  void
	 */
	public function __set($name, $value)
	{
		$this->set($name, $value);
	}
	
	/**
	 * Get
	 *
	 * To do
	 *
	 * @param   string  $name  The field's name
	 * @return  mixed
	 */
	public function get($name)
	{	
		if(method_exists($this, $name))
		{
			return $this->{$name}();	
		}
		if(array_key_exists($name, $this->_properties)) 
		{
			return $this->{$name};
		}
		return FALSE;
	}

	/**
	 * Sets
	 *
	 * To do
	 *
	 * @param   string  $name
	 * @param   string  $value
	 * @return  Jelly   Returns $this
	 */
	public function set($name, $value = NULL)
	{
		if(method_exists($this, $name))
		{
			return $this->{$name}($value);	
		}
		if(array_key_exists($name, $this->_properties))
		{
			$this->{$name} = $value;
		}
		return $this;
	}
	
	/**
	 * View
	 *
	 * To do
	 *
	 * @param   string  $view  
	 * @return  mixed
	 */
	public function view($view = NULL)
	{
		if(is_string($view))
		{
			$this->_view = $view;
			return $this;
		}
		
		return $this->_view;
	}
	
	/**
	 * Fieldsets
	 *
	 * Desc
	 *
	 * @param   string  $name  The field's name
	 * @return  mixed
	 */
	public function render()
	{
		try
		{
			$view = View::factory($this->view().'/'.$this->get('type'));
			
			foreach($this->_properties as $key => $value)
			{
				$data[$key] = $this->get($key);
				$view->bind($key, $data[$key]);
			}
			
			return $view->render();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}