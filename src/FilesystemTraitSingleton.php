<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitSingleton
{

	protected static $instance;

	public static function getInstance()
	{

		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;

	}

}
