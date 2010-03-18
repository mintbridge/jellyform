<?php echo Form::open($action);?>
<?php foreach($elements as $element):?>
<?php echo $element;?>
<?php endforeach;?>
<?php echo Form::close();?>