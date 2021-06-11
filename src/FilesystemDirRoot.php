<?php

namespace nathanwooten\Filesystem;

class FilesystemDirRoot
{

	public $segments = [ 'C:', 'nathanwooten', 'Operation', 'Violet', 'HomeBranch', 'Profordable', 'Projects', 'simplewebsite', 'Dev', 'Home', 'src' ];

	public function __construct()
	{

		$this->path = new FilesystemDir( $this->segments );

	}

	public function getPath()
	{

		return $this->path;

	}

}
