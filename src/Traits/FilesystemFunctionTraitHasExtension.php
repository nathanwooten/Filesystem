<?php

namespace nathanwooten\Filesystem\Traits;

use function nathanwooten\Filesystem\Functions\has_extension;

trait FilesystemFunctionTraitHasExtension
{

	public function has_extension( $item )
	{

		return has_extension( $item );

	}

}
