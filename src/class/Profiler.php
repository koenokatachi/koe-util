<?php

namespace koe\util;

class Profiler {

	private $data, $running, $_tick;

	public function __construct() {
		$this->data = array();
		$this->running = '';
	}

	public function tick($key) {
		if ($this->running) {
			if ($this->running == $key) {
				return;
			}

			$this->tock();
		}

		$this->running = $key;
		$this->_tick = microtime(true);
	}

	public function tock() {
		if ($this->running) {
			@$this->data[$this->running] += microtime(true) - $this->_tick;
			$this->running = '';
		}
	}

	public function report($title = '') {
		$this->tock();

		if ($title) {
			_eprintln(sprintf('-- %s', $title));
		}

		$total = array_sum($this->data);
		foreach ($this->data as $key => $time) {
			_eprintln(sprintf('%s: %.2f%%', $key, 100 * $time / $total));
		}

		_eprintln(sprintf('-- total: %.3fs', $total));
	}

}
