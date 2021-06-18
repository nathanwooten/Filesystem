<?php

namespace nathanwooten\Filesystem;

trait FilesystemTrait {

	public function filesystem()
	{

		return Filesystem::getInstance();

	}

	public static function filesystemStatic()
	{

		return Filesystem::getInstance();

	}

	public function factory()
	{

		return $this->filesystem()->factory();

	}

	public static function factoryStatic()
	{

		return self::filesystemStatic()->factory();

	}

}
