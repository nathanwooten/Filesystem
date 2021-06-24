<?php

namespace nathanwooten\Filesystem\Traits;

use function nathanwooten\Filesystem\Functions\apply_filters_item;

trait FilesystemFunctionTraitApplyFiltersItem
{

	public function apply_filters_item( $item, $filters, $extra = null )
	{

		return apply_filters_item( $item, $filters, $extra );

	}

}
