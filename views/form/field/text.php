<?php echo Form::label($name, $label);?>
<?php echo Form::textarea($name, $value, array(
	'id' => $id,
	'class' => $class,
	'rows' => 8,
	'cols' => 40,
)); ?>