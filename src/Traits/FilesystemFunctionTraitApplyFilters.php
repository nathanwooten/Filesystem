<?php

namespace nathanwooten\Filesystem\Traits;

use function nathanwooten\Filesystem\Functions\apply_filters;

trait FilesystemFunctionTraitApplyFilters
{

	public function apply_filters( $scan, $filters, $extra = null )
	{

		return apply_filters( $scan, $filters, $extra );

	}

}
