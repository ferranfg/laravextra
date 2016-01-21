<?php

namespace Ferranfg\Laravextra\Models;

use Illuminate\Html\FormFacade as Form;
use Ferranfg\Laravextra\Facades\Input;

trait BaseModel
{
	public function input($prop, $name = null, $type = 'text', $extra = [])
	{
		if (is_null($name)) $name = $prop;

		$extra = array_merge(['class' => 'form-control', 'id' => $prop], $extra);

		return Form::$type($name, Input::old($name, $this->$prop), $extra);
	}

	public function currency($prop, $name = null)
	{
		return '<div class="input-group">'.$this->input($prop, $name).'<span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span></div>';
	}

	public function datetime($prop, $name = null)
	{
		return $this->input($prop, $name, 'text', ['class' => 'form-control datetime']);
	}

	public function time($prop, $name = null)
	{
		return $this->input($prop, $name, 'text', ['class' => 'form-control time']);
	}

	public function textarea($prop, $name = null)
	{
		return $this->input($prop, $name, 'textarea', ['class' => 'form-control', 'rows' => 8]);
	}

	public function options($name, $options = [])
	{
		$options = empty($options) ? [1 => 'Active', '' => 'Disable'] : $options;

		return Form::select($name, $options, $this->$name, ['class' => 'form-control']);
	}

	public function getStatusIcon()
	{
		if ($this->active) return '<span class="glyphicon glyphicon-ok" data-toggle="tooltip" title="Active"></span>';

		return '<span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Disabled"></span>';
	}

}