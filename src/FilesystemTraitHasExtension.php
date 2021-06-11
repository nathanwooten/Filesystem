<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitHasExtension {

	public function hasExtension( $file )
	{

		return ( new FilesystemHelperHasExtension )->hasExtension( $file );

	}

}
