<?php

namespace nathanwooten\Filesystem;

class FilesystemHelperIsReadable
{

	use FilesystemTraitNormalize;
	use FilesystemTraitRoot;

	public function isReadable( $data )
	{

		$root = $this->normalize( $this->root() );

		$readable = $root . $this->normalize( $data, 'toString' );
		if ( ! is_readable( $readable ) ) {

			return false;
		}

		return $readable;

	}

}
