<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitExplode
{

	public function explode( string $explode )
	{

		return ( new FilesystemHelperExplode )->explode( $explode );

	}

}
