<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Jelly_Form_Field_Core 
 * 
 * @package Jelly
 */
abstract class Jelly_Form_Element_Core
{
	/**
	 * @var  string  
	 *
	 * Specifies a unique id for an element
	 */
	protected $id = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies a classname for an element
	 */
	protected $class = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the name for the element
	 */
	protected $name = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies the text direction for the content in an element
	 */
	protected $dir = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies a language code for the content in an element
	 */
	protected $lang = '';
	
	/**
	 * @var  string 
	 *
	 * Specifies an inline style for an element
	 */
	protected $style = '';
	
	/**
	 * @var  string  
	 *
	 * Specifies extra information about an element
	 */
	protected $title = '';
	
	/**
	 * @var  string  
	 *
	 * Name of the view to be rendered
	 */
	protected $_view = '';	
	
	/**
	 * @var  array  
	 *
	 * Specifies the attributes the element has
	 */
	protected $_attributes = array();
	
	/**
	 * @var  array  
	 *
	 * Specifies the attributes view requires to be set
	 */
	protected $_required = array();
	
	/**
	 * Constructor.
	 *
	 * Create the attributes array and set up any passed values
	 *
	 * @param  array  $values
	 **/
	public function __construct(array $attributes = NULL)
	{
		$_attributes = (array) get_object_vars($this);
		foreach($_attributes as $attribute => $value) 
		{
			if(strpos($attribute,'_') !== 0)
			{
				$this->_attributes[$attribute] = $value;
			}
		}
		
		if(method_exists($this, 'initialize'))
		{
			$this->initialize();
		}
		
		if(is_array($attributes)) 
		{
			foreach($attributes as $attribute => $value) 
			{
				if(!in_array($attribute, array('name', 'value')))
				{
					$this->set($attribute, $value);
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
	public function __get($attribute)
	{	
		return $this->get($attribute);
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
	public function __set($attribute, $value)
	{
		$this->set($attribute, $value);
	}
	
	/**
	 * Get
	 *
	 * To do
	 *
	 * @param   string  $name  The field's name
	 * @return  mixed
	 */
	public function get($attribute)
	{	
		if(method_exists($this, $attribute))
		{
			return $this->{$attribute}();	
		}
		if(array_key_exists($attribute, $this->_attributes)) 
		{
			return $this->{$attribute};
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
	public function set($attribute, $value = NULL)
	{
		if(method_exists($this, $attribute))
		{
			return $this->{$attribute}($value);	
		}
		if(array_key_exists($attribute, $this->_attributes))
		{	
			if(is_array($this->_attributes[$attribute]))
			{
				if(in_array($value, $this->_attributes[$attribute]))
				{
					$this->{$attribute} = $value;
				}
			}
			else
			{
				$this->{$attribute} = $value;
			}
		}
		return $this;
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
			$view = View::factory($this->_view);
			
			$attributes = $this->_attributes;
			$required = $this->_required;
			$data = array();
			
			foreach($attributes as $attribute => $value)
			{
				if(!in_array($attribute, $required))
				{
					if(is_array($this->{$attribute}))
					{
						$data[$attribute] = $this->{$attribute}[0];
					}
					elseif($this->{$attribute} != '')
					{
						$data[$attribute] = $this->{$attribute};
					}
				}
			}
			$view->bind('attributes', $data);
			
			foreach($required as $attribute)
			{
				$view->bind(''.$attribute, $this->{$attribute});
			}			
			return $view->render();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}