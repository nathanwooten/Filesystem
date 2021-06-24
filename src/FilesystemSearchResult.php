<?php

namespace nathanwooten\Filesystem;

use Countable;
use ArrayAccess;

class FilesystemSearchResult implements Countable, ArrayAccess
{

	public $container = [];
	public $result = false;
	public $term;

	public function __construct( $term ) {

		$this->term = $term;

	}

	public function get()
	{

		if ( false !== $this->result ) {
			return $this->offsetGet( $this->getPointer() );
		}

	}

	public function getTerm()
	{

		return $this->term;

	}

	public function getPointer()
	{

		return $this->result;

	}

	public function addResult( $result )
	{

		$this->container[] = $result;

		$this->result = key( $this->container );

	}

	public function getNext()
	{

		$pointer = & $this->result;
		if ( $pointer >= count( $this->result ) ) {
			return false;
		}

		return ++$pointer;

	}

	public function getPrev()
	{

		$pointer = & $this->result;
		if ( ! $pointer ) {
			return false;
		}

		return --$pointer;

	}

	public function offsetExists( $offset )
	{

		return array_key_exists( $offset, $this->container );

	}

	public function offsetGet( $offset )
	{

		return isset( $this->container[ $offset ] ) ? $this->container[ $offset ] : null;

	}

	public function offsetSet( $offset, $value )
	{

		$this->container[ $offset ] = $value;

	}

	public function offsetUnset( $offset )	
	{

		unset( $this->container[ $offset ] );

	}

	public function count()
	{

		return count( $this->container );

	}

}
