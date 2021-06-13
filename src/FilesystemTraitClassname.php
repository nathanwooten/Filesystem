<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\FilesystemTraitHelper;

trait FilesystemTraitClassname
{

	use FilesystemTraitHelper;

	public function toAlias( $qualified )
	{

		return $this->act( __TRAIT__, __FUNCTION__, [ $qualified ] );

	}

	public function fromAlias( $alias )
	{

		return $this->act( __TRAIT__, __FUNCTION__, [ $alias ] );

	}

}
