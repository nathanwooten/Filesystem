<?php

namespace nathanwooten\Filesystem;

class FilesystemHelperHasExtension
{

	public function hasExtension( $file )
	{

		$pos = strpos( $file, '.' );

		if ( false !== $pos ) {
			$sepPos = strpos( $file, DIRECTORY_SEPARATOR );

			if ( $pos > $sepPos ) {
				return true;
			}
		}

		return false;

	}

}
