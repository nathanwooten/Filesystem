<?php

namespace nathanwooten\Filesystem;

trait FilesystemTrait
{

	public function filesystem()
	{

		return Filesystem::getInstance();

	}

}
