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

	use FilesystemTraitExplode;
	use FilesystemTraitImplode;
	use FilesystemTraitNormalize;
	use FilesystemTraitRoot;
	use FilesystemTraitScan;

	public $segments = [];
	public $scan = [];
	public $structure = [];

	public function __construct( $segments )
	{

		if ( ! is_array( $segments ) ) {
			$this->segments = $this->explode( $segments );
		} else {
			$this->segments = $this->normalize( $segments );
		}

		$this->scan = $this->scan( $this->segments, [ new FilesystemFilterDot ] );

	}

	public function offsetGet( $offset ) {

		$count = count( $this->segments );


	}

	public function OffsetSet( $offset, $value )
	{

		$count = count( $this->getSegments() );
		if ( $count >= $offset ) {

			$this->segments[ $offset ] = $value;

		} elseif ( $count < $offset ) {


		}



	}

	public function locateString( string $string )
	{

		$location = false;

		$key = $this->search( $this->segments, $string );
		if ( false !== $key ) {
			$location = $key;
		}

		if ( false === $location ) {

			$key = $this->search( $this->scan, $string );
			if ( false !== $key ) {
				$location = count( $this->segments );
			}
		}

		if ( false === $location ) {

			$fullScanFrom = $this->root()->getPath()->iterateScan( $this->segments );

			if ( ! $fullScanFrom ) {
				throw new Exception( 'Could not retrieve full scan' );
			}

			$key = $this->searchStructure( $fullScanFrom, $string );

			if ( false !== $key ) {
				$location = $key;
			}

		}

		return $location;

	}

	public function search( array $array, string $string )
	{

		$location = false;

		foreach ( $array as $key => $segment ) {

			if ( false !== strpos( $segment, $string ) ) {
				$location = $key;
				break;
			}
		}

		return $location;

	}

	public function searchStructure( array $structure, string $string ) {

		$location = false;

		$keys = array_keys( $structure );

		foreach ( $structure as $dir => $contents ) {

			if ( $this->strpos_( $dir, $string ) ) {
				$location = array_search( $dir, $keys );
				break;
			}

			if ( $contents ) {

				$location = $this->searchStructure( $contents, $string );
			}
		}

		return $location;

	}

	public function strpos_( $dir, $string )
	{

		return strpos( strtolower( $dir ), strtolower( $string ) );

	}

	public function isReadable( $data )
	{

		$root = $this->normalize( $this->root() );

		$readable = $root . (string) $this->normalize( $data );
		if ( ! is_readable( $readable ) ) {

			return false;
		}

		return $readable;

	}

	public function spl( $readable ) {

		if ( ! isset( $this->spl ) && $readable ) {
			$this->spl = new SplFileInfo( $readable );
		}

	}

}
