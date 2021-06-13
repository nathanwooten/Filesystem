<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemTraitExplode,
	FilesystemTraitImplode,
	FilesystemTraitNormalize,
	FilesystemTraitRoot,
	FilesystemTraitScan

};

use Exception;

class FilesystemDir
{

	use FilesystemTrait;
	use FilesystemTraitExplode;
	use FilesystemTraitImplode;
	use FilesystemTraitNormalize;
	use FilesystemTraitRoot;
	use FilesystemTraitScan;

	protected $children = [];
	protected $input;
	protected $normal;
	protected $parent_;
	protected $scan = [];

	public function __construct( $directory )
	{

		$this->input = $directory;
		$this->scan = $this->scan( $this->input, [ new FilesystemFilterDot, new FilesystemFileterDirectoryNot ] );

	}

	public function getDirectory( $input = null, $to = null )
	{

		return $this->normalize( $input ? $input : $this->input, $to );

	}

	public function getName()
	{

		$directory = $this->getDirectory( null, 'array' );
		$name = array_pop( $directory );

		return $name;

	}

	public function getNormal() {

		if ( ! isset( $this->normal ) || ! $this->upToDate() ) {
			$this->normal = $this->getDirectory();
		}

		return $this->normal();

	}

	public function __toString()
	{

		return $this->getName();

	}

	public function processValue( $value ) {


	}

	public function offsetGet( $offset ) {

		$got = null;

		if ( ! $this->offsetHas( $offset ) ) {
			if ( ! $this->scanHas( $offset ) ) {
				return null;
			}

			$name = $this->scan[ $offset ];
			$directory = $this->getDirectory( null, 'string' )

			$offsetItem = $directory . $name;
			$directoryObject = $this->factory()->createDirectory( $offsetItem );

			$this->offsetSet( $offset, $directoryObject );
		}

		$directoryObject = $this->children[ $offset ];

		return $directoryObject;

	}

	public function offsetSet( $offset, $value )
	{

		$directoryObject = $this->processValue( $value );
		if ( $this->offsetHas( $offset ) ) {

			$this->children[ $offset ] = $directoryObject;
		}

	}

	public function offsetHas( $offset ) {

		if ( array_key_exists( $offset, $this->children ) ) {



		}

	}

	public function getParent()
	{

		return $this->parent_;

	}

	public function getChildren()
	{

		return $this->children;

	}

	public function getScan()
	{

		return $this->scan;

	}

	public function upToDate()
	{

		return true;

	}

}
