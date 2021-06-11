<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitNormalize
{

	public function normalize( $normalize )
	{

		return ( new FilesystemHelperNormalize )->normalize( $normalize );

	}

}
