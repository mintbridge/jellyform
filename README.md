JellyForm is a form building module for Jelly. It is currently in development and will change.

Currently there are only a few fields types but others will be added shortly.

Its possible to pass models to the form, that can be used to set the value of a field, the field definition should include a models propety that specifies the model and field to use eg 
<pre>
'model.field1' => new Jelly_Form_String(array(
	'label' => 'Name',
	'model' => 'modelname.fieldname',
)),
</pre>
This is still under development, so currently only the field value gets set. Other values such as labels, rules, etc will also be possible soon.

Example Usage

<pre>
class Form_Example extends Jelly_form {

	function initialize()
	{
		$this->set('action', 'action')
		->elements(array(
			'model.field1' => new Jelly_Form_String(array(
				'label' => 'Name',
			)),
			'model.field2' => new Jelly_Form_Text(array(
				'label' => 'Description',
			)),
			'fieldset' => new Jelly_Form_Fieldset(array(
				'legend' => 'Im a legend',
				'elements' => array(
					'anothermodel.field1' => new Jelly_Form_Email(array(
						'label' => 'Label1',
						'class' => 'large',
					)),
					'anothermodel.field2' => new Jelly_Form_String(array(
						'label' => 'Another Label',
					)),
					'anothermodel.field3' => new Jelly_Form_Enum(array(
						'label' => 'Blah',
						'options' => array(
							'1' => 'Option 1', 
							'2' => 'Option 2',		
						),
					)),
					'anothermodel.field4' => new Jelly_Form_String(array(
						'label' => 'Foooooo',
					)),
					'anothermodel.field5' => new Jelly_Form_Password(array(
						'label' => 'Password',
					)),
				),
			)),
		));
	}
}

</pre>

Then to display the form in your view just use 
<pre>
echo $form;
</pre>
or alternatively you can just display parts of the form eg.

just show fieldset_one
<pre>
echo $form->elements('fieldset_one');
</pre>

or just show the email field
<pre>
echo $form->elements('fieldset_one')->elements('email');
</pre>

or loop trhough a set of elements
<pre>
foreach($form->elements('fieldset_one')->elements() as $element)
{
	echo $element;
}
</pre>