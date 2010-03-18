<fieldset <?php echo ($id) ? 'id="'.$id.'"' : ''; ?> <?php echo ($class) ? 'class="'.$class.'"' : ''; ?>>
<?php echo ($legend) ? '<legend>'.$legend.'</legend>' : ''; ?>
<?php foreach($elements as $element):?>
<?php echo $element;?>
<?php endforeach;?>
</fieldset>