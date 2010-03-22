<?php echo Form::label($name, $label);?>
<?php 
echo Form::input($name, $value, array(
	'id' => $id,
	'class' => $class,
)); 
?>