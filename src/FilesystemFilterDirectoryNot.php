<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemFilterInterface,
	FilesystemTraitHasExtension

};

class FilesystemFilterDirectoryNot implements FilesystemFilterInterface
{

	use FilesystemTraitHasExtension;

	public function __invoke( $value )
	{

		if ( $this->hasExtension( $value ) ) {
			return;
		}

		return $value;

	}

}
