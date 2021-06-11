<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitRoot
{

	public function root()
	{

		return Filesystem::getInstance()->getPath( true );

	}

}
