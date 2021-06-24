<?php

namespace nathanwooten\Filesystem;

use function nathanwooten\Filesystem\Functions\scan;

trait FilesystemFunctionTraitScan
{

	public function scan( $directory, array $filters = [] )
	{

		return scan( $directory, $filters );

	}

}
