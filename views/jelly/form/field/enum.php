<?php defined('SYSPATH') or die('No direct script access.');?>
<?php echo Form::label($name, $label);?>
<?php echo Form::select($name, $options, $value, $attributes); ?>