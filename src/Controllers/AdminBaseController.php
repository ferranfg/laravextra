<?php

namespace Ferranfg\Laravextra\Controllers;

use Ferranfg\Laravextra\Facades\Input;
use Carbon\Carbon;

trait AdminBaseController
{
	public function getNew()
	{
		return $this->getEdit(null);
	}

	protected function save($model, $url, $callback = null)
	{
		$fields = Input::except($this->notSave);
		$object = Input::has('id') ? $model::find(Input::get('id')) : $model::newInstance();

		foreach ($fields as $field => $value)
		{
			$object->$field = $value;
		}

		$object->updated_at = Carbon::now();
		
		if (!$object->id) $object->save();

		if (is_callable($callback)) $object = $callback($object);

		$object->save();

		return redirect("admin/{$url}/edit/{$object->id}")->with('success', 'Changes saved successfully.');
	}

	protected function delete($model, $id)
	{
		$model::destroy($id);

		return redirect()->back()->with('info', "<b>{$model}</b> #{$id} has been deleted.");
	}
}