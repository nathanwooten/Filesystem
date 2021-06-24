<?php

namespace nathanwooten\Filesystem\Traits;

use function nathanwooten\Filesystem\Functions\qualify;

trait FilesystemFunctionTraitQualify
{

	public function qualify( $alias )
	{

		return qualify( $alias );

	}

}
