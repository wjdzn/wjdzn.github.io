<?php namespace App\Models\Cart;

use Illuminate\Support\Collection;

class CartRowOptionsCollection extends Collection {

	public function __construct($items)
	{
		parent::__construct($items);
	}

	public function __get($arg)
	{
		if($this->has($arg))
		{
			return $this->get($arg);
		}

		return NULL;
	}

	public function search($search, $strict = false)
	{
		foreach($search as $key => $value)
		{
			$found = ($this->{$key} === $value) ? true : false;

			if( ! $found) return false;
		}

		return $found;
	}

<<<<<<< HEAD
}
=======
}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
