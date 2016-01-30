<?php

namespace koe\util;

class Progress {

	private $total, $current;

	public function __construct($total) {
		$this->total = $total;
		$this->current = 0;
	}

	public function track($step = 1) {
		$this->current += $step;
		_eprint(sprintf("\r%8.2f%%", 100 * $this->current / $this->total));
	}

	public function done() {
		_eprintln();
	}

}
