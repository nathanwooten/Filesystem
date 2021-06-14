<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\FilesystemTraitHelper;

trait FilesystemTraitType
{

	use FilesystemTraitHelper;

	public function toAlias( $qualified )
	{

		return $this->helpTrait( __TRAIT__, __FUNCTION__, [ $qualified ] );

	}

	public function fromAlias( $alias )
	{

		return $this->helpTrait( __TRAIT__, __FUNCTION__, [ $alias ] );

	}

}
