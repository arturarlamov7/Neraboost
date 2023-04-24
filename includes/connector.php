<?php
	$dir = ROOT . "/classes/";

	$scan = scandir($dir);

	unset($scan[0]);
	unset($scan[1]);

	foreach($scan as $file) {
		@require_once($dir . $file);
	}
?>