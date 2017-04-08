<?php

namespace koe\util;

class Progress {

	private $total;
	private $current = 0;
	private $interval;
	private $into = 0;

	public function __construct($total, $interval = 1) {
		$this->total = $total;
		$this->interval = $interval;
	}

	private function log() {
		_eprint(sprintf("\r%8.2f%%", 100 * $this->current / $this->total));
	}

	public function track($step = 1) {
		$this->current += $step;

		$this->into += $step;
		if ($this->into >= $this->interval) {
			$this->into = 0;
			$this->log();
		}
	}

	public function done() {
		if ($this->into > 0) {
			$this->log();
		}

		_eprintln();
	}

}
