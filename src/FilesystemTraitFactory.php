<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\FilesystemFactory;

trait FilesystemTraitFactory {

	public function factory()
	{

		return new FilesystemFactory;

	}

}
