<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemTraitFactory,
	FilesystemTraitNormalize,
	FilesystemTraitSingleton

};

use Exception;

class Filesystem//implements FilesystemRegistersInterface
{

	use FilesystemTraitFactory;
	use FilesystemTraitSingleton;

	protected $domain;
	protected $locked = false;
	protected $root = [ 'C:', 'nathanwooten', 'Operation', 'Violet', 'HomeBranch', 'Profordable', 'Projects', 'simplewebsite', 'Dev', 'Home', 'src' ];

	protected function __construct( $root = null ) {

		$this->setRoot( $root );

	}

	public function domain()
	{

		return $this->domain;

	}

	public function setRoot( $root = null )
	{

		if ( $root && ! isset( $this->root ) || ! $this->locked ) {

			$this->root = $root;
			$this->setDomain( $this->create() );

			$this->locked = true;
		}

	}

	public function getRoot()
	{

		return $this->root;

	}

	public function unlock()
	{

		$this->locked = false;

		return $this;

	}

	protected function setDomain( FilesystemDirectory $directory ) {

		$this->domain = $directory;

	}

	protected function create()
	{

		return $this->factory()->createDirectory( $this->root );

	}

}
