<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Jelly_Form_Field_Core 
 * 
 * @package Jelly
 */
abstract class Jelly_Form_Element_Core
{
	/**
	 * @var  array  
	 *
	 * Specifies the attributes values that have been set 
	 */
	protected $attributes = array();
	
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
				$this->set($attribute, $value);
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
			if(is_array($this->_attributes[$attribute]) and !is_array($value))
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
	 * attibrutes
	 *
	 * return an arrya of attributes set for the element
	 *
	 * @return  array
	 */
	public function attributes()
	{
		$_attributes = $this->_attributes;
		$_required = $this->_required;
		
		$attributes = array();
		foreach($_attributes as $_attribute => $value)
		{
			//we dont want to include the attributes property in the attributes array!
			if($_attribute == 'attributes')
			{
				continue;
			}
			if(!in_array($_attribute, $_required))
			{
				//if the property is an array then pick the first value from the array
				if(is_array($this->{$_attribute}) && count($this->{$_attribute})> 0)
				{
					$attributes[$_attribute] = $this->{$_attribute}[0];
				}
				elseif($this->{$_attribute} != '')
				{
					$attributes[$_attribute] = $this->{$_attribute};
				}
			}
		}
		return (array) $attributes;
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
			$_required = $this->_required;
			
			$attributes = $this->attributes();
			
			$view->bind('attributes', $attributes);
			
			foreach($_required as $var)
			{
				$view->bind(''.$var, $this->{$var});
			}			
			return $view->render();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}