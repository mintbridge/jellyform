<?php defined('SYSPATH') or die('No direct script access.');?>
<?php echo Form::label($name, $label);?>
<?php echo Form::input($name, date($pretty_format, $value), $attributes); ?>