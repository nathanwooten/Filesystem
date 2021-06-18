<?php

namespace nathanwooten\Filesystem;

class FilesystemFilterDot implements FilesystemFilterInterface {

	public function __invoke( $value )
	{

		if ( '.' === $value ) return null;

		return $value;

	}

}
