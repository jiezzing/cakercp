<?php

	if (Configure::read('debug') > 0) {
		$this->layout = 'error500';
	}
