<?php

namespace nathanwooten\Filesystem\Traits;

use function nathanwooten\Filesystem\Functions\normalize;

trait FilesystemFunctionTraitNormalize
{

	public function normalize( $input ) {

		return normalize( $input );

	}

}
