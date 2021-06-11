<?php

namespace nathanwooten\Filesystem;

class Filesystem
{

	use FilesystemTraitExplode;
	use FilesystemTraitImplode;
	use FilesystemTraitNormalize;
	use FilesystemTraitSeparator;
	use FilesystemTraitSingleton;

	public $path;

	protected function __construct() {}

	public function getPath( $root = false )
	{

		if ( ! isset( $this->path ) ) {

			$this->path = new FilesystemDirRoot;
		}

		$path = $this->path;
		if ( ! $root ) {
			$path = $path->getPath();
		}

		return $path;

	}

}
