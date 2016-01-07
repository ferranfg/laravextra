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

	public function datetime($prop, $name = null)
	{
		return $this->input($prop, $name, 'text', ['class' => 'form-control datetime']);
	}

	public function textarea($prop, $name = null)
	{
		return $this->input($prop, $name, 'textarea', ['class' => 'form-control', 'rows' => 4]);
	}
}