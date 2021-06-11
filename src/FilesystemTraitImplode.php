<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitImplode
{

	public function implode( array $implode = null, $separator = '' )
	{

		return ( new FilesystemHelperImplode )->implode( $implode, $separator );

	}

}
