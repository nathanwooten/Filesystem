<?php

namespace nathanwooten\Filesystem;

use function nathanwooten\Filesystem\Functions\strpos_;

trait FilesystemFunctionTraitStrpos
{

	public function strpos_( $haystack, $needle )
	{

		return strpos_( $haystack, $needle );

	}

}
