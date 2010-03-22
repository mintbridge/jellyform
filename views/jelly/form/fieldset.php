<fieldset <?php echo HTML::attributes($attributes) ?>>
<?php if($legend != ''):?>
<legend><?php echo $legend; ?></legend>
<?php endif;?>
<?php foreach($elements as $element):?>
<?php echo $element;?>
<?php endforeach;?>
</fieldset>