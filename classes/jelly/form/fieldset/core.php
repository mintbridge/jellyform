<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Jelly_Form_Fieldset_Core 
 * 
 * @package Jelly
 */
abstract class Jelly_Form_Fieldset_Core extends Jelly_Form_Element
{
	
	/**
	 * @var  string  
	 */
	protected $legend = '';
	
	/**
	 * @var  array  
	 */
	protected $elements = array();
	
	/**
	 * @var  string  
	 */
	protected $_view = 'jelly/form/fieldset';
	
	/**
	 * @var  array  
	 */
	protected $_required = array('elements', 'legend');
	
	/**
	 * Elements
	 *
	 * To do
	 *
	 * @param   string  $element  
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
		
		if(is_string($element) && array_key_exists($element, $this->elements))
		{
			return $this->elements[$element];
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