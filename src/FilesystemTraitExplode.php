<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitExplode
{

	public function explode( $explode = null )
	{

		return ( new FilesystemHelperExplode )->explode( $explode );

	}

}
