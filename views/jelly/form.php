<?php echo Form::open($action, $attributes);?>
<?php foreach($elements as $element):?>
<?php echo $element;?>
<?php endforeach;?>
<?php echo Form::close();?>