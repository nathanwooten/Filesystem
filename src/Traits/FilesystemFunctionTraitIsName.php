<?php

namespace nathanwooten\Filesystem\Traits;

use function nathanwooten\Filesystem\Functions\is_name;

trait FilesystemFunctionTraitIsName
{

	public function is_name( $mixed )
	{

		return is_name( $mixed );

	}

}
