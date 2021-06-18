<?php

namespace nathanwooten\Filesystem;

class FilesystemFilterDotDot implements FilesystemFilterInterface {

	public function __invoke( $value )
	{

		if ( '..' === $value ) return null;

		return $value;

	}

}
