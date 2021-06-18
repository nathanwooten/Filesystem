<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemFilter,
	FilesystemTrait

};

class FilesystemFilterDirectoryNot implements FilesystemFilter
{

	use FilesystemTrait;

	public function __invoke( $value )
	{

		if ( $this->filesystem()->type()->hasExtension( $value ) ) {
			return;
		}

		return $value;

	}

}
