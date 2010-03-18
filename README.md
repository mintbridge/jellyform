JellyForm is a form building module for Jelly. It is currently in development and will change

Example Usage

At the moment you need to pass the elements when creating the for instance but im planning on allowing them to be loaded from a config file, and also added in parts by using elements()

<pre>
$form = Jelly_Form::instance('form/instance', array(
			'action' => 'controller/action',						   
			'elements' => array(
				'first_field' => new Jelly_Form_Field(array(
					'label' => 'First Field',
					'type' => 'text',
					'default' => '',
				)),
				'fieldset_one' => new Jelly_Form_Fieldset(array(
					'legend' => 'Im a legend',
					'elements' => array(
						'name' => new Jelly_Form_Field(array(
							'label' => 'Name',
							'type' => 'string',
							'class' => 'medium',
							'default' => '',
						)),
						'description' => new Jelly_Form_Field(array(
							'label' => 'Description',
							'type' => 'text',
							'default' => '',
						)),
						'second_fieldset' => new Jelly_Form_Fieldset(array(
							'legend' => '',
							'elements' => array(
								'phone' => new Jelly_Form_Field(array(
									'label' => 'Phone',
									'type' => 'string',
									'default' => '',
								)),
								'email' => new Jelly_Form_Field(array(
									'label' => 'Email',
									'type' => 'string',
									'default' => '',
								)),
							)
						)),
					)
				)),
			),
		));
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