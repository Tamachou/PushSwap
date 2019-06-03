<?php

class Swap
{
	public $la = [];
	public $lb = [];
	public $op = [];
	public function __construct($argv)
	{
		$this->la = $argv;
//		while(count($this->la) !== 100)
//		{
//			array_push($this->la,rand(0,100));
//		}

	}
	/*
	* Function swap
	 */
	public function sa($push = true)
	{
		if (count($this->la) >= 2 )
		{
			$temp = $this->la[0];
			$this->la[0] = $this->la[1];
			$this->la[1] = $temp;
			if ($push)
			{
				array_push($this->op, 'sa');
			}
		}
	}
	public function sb($push = true)
	{
		if (count($this->lb) >= 2 )
		{
			$temp = $this->lb[0];
			$this->lb[0] = $this->lb[1];
			$this->lb[1] = $temp;
			if ($push)
			{
				array_push($this->op, 'sb');
			}
		}
	}

	public function sc()
	{
		$this->sa(false);
		$this->sb(false);
		array_push($this->op, 'sc');
	}
	/*
	 * function take
	 */
	public function pa()
	{
		if(!empty($this->lb))
		{
			array_unshift($this->la, array_shift($this->lb));
			array_push($this->op, 'pa');
		}
	}
	public function pb()
	{
		if(!empty($this->la))
		{
			array_unshift($this->lb, array_shift($this->la));
			array_push($this->op, 'pb');
		}
	}
	/*
	 * function rotation
	 */
	public function ra($push = true)
	{
		array_push($this->la, array_shift($this->la));
		if ($push)
		{
			array_push($this->op, 'ra');
		}
	}
	public function rb($push = true)
	{
		array_push($this->lb, array_shift($this->lb));
		if ($push)
		{
			array_push($this->op, 'rb');
		}
	}
	public function rr()
	{
		$this->ra(false);
		$this->rb(false);
		array_push($this->op, 'rr');
	}
	/*
	 * function inverse rotation
	 */
	public function rra($push = true)
	{
		array_unshift($this->la, array_pop($this->la));
		if($push)
		{
			array_push($this->op, 'rra');
		}
	}
	public function rrb($push = true)
	{
		array_unshift($this->lb, array_pop($this->lb));
		if($push)
		{
			array_push($this->op, 'rrb');
		}
	}
	public function rrr()
	{
		$this->rra(false);
		$this->rrb(false);
		array_push($this->op, 'rrr');
	}

	public function sort()
	{
		while(!empty($this->la))
		{
			$min = min($this->la);
			$key = array_search($min, $this->la);
			$lenght = count($this->la);
			if($this->la[0] !== $min)
			{
				if($key > $lenght/2)
				{
					$this->rra();
				} else{
					$this->ra();
				}

			} else {
				$this->pb();
			}
		}
		while(!empty($this->lb))
		{
			$this->pa();
		}
		echo implode(' ', $this->op) . "\n";
		return $this->la;
	}
}

array_shift($argv);
$test = new Swap($argv);
$test->sort();
