<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Jelly_Form_Core 
 * 
 * @package Jelly
 */
abstract class Jelly_Form_Core
{
	/**
	 * @var  array  Form instances
	 */
	public static $instances = array();
	
	/**
	 * @var  string Form action   
	 */
	private $action = '';
	
	/**
	 * @var  string Form method   
	 */
	private $method = 'POST';
	
	/**
	 * @var  array  
	 */
	private $_properties = array();
	
	/**
	 * @var  array  
	 */
	private $_models = array();
	
	/**
	 * @var  array  
	 */
	private $elements = array();
	
	/**
	 * @var  array  
	 */
	private $_errors = array();
	
	/**
	 * @var  string  
	 */
	private $_view = 'form/form';
	
	/**
	 * Get a singleton Database instance. If configuration is not specified,
	 * it will be loaded from the database configuration file using the same
	 * group as the name.
	 *
	 * @param   string   instance name
	 * @param   array    configuration parameters
	 * @return  Database
	 */
	public static function instance($name, array $properties = NULL)
	{
		if ( ! isset(Jelly_Form::$instances[$name]))
		{
			new Jelly_Form($name, $properties);
		}

		return Jelly_Form::$instances[$name];
	}

	/**
	 * Constructor.
	 *
	 * To do
	 *
	 * @param  name  $values
	 * @param  array  $properties
	 **/
	final protected function __construct($name, array $properties = NULL)
	{
		// Set the instance name
		$this->_instance = $name;

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
		
		// Store the Jelly Form instance
		Jelly_Form::$instances[$name] = $this;
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
	 * Set
	 *
	 * To do
	 *
	 * @param   string  $name
	 * @param   mixed  	$value
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
	 * Elements
	 *
	 * To do
	 *
	 * @param   mixed  $element  
	 * @return  mixed
	 */
	public function elements($element = NULL)
	{
		if (func_num_args() == 0)
		{
			return $this->elements;
		}

		if (is_array($element))
		{
			// Allows fields to be appended
			$this->elements += $element;
			return $this;
		}
		
		if(is_string($element))
		{
			if(array_key_exists($element, $this->elements))
			{
				return $this->elements[$element];
			}
			return FALSE;
		}
		
		return $this->elements;
	}
	
	/**
	 * Method
	 *
	 * To do
	 *
	 * @param   string  $name  The form method 
	 * @return  mixed
	 */
	public function method($method = NULL)
	{
		if(is_string($method) and in_array($method, array('POST', 'GET')))
		{
			$this->method = $method;
			return $this;
		}
		return $this->method;
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
	 * Render
	 *
	 * To do
	 *
	 * @return  string
	 */
	public function render()
	{
		try
		{
			$view = View::factory($this->view());
			
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