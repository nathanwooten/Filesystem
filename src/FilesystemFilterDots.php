<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\FilesystemFilterInterface;

class FilesystemFilterDots implements FilesystemFilterInterface {

	public function __invoke( $value )
	{

		if ( '.' === $value || '..' === $value ) return null;

		return $value;

	}

}
