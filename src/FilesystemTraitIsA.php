<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\FilesystemTraitHelper;

trait FilesystemTraitIsA {

	use FilesystemTraitHelper;

	public function isA( $obj, $interface )
	{

		return $this->act( __TRAIT__, __FUNCTION__, ...func_get_args() );

	}

}
