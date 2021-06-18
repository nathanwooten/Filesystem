<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemPackage,
	FilesystemInput,
	FilesystemFilter

};

use Exception;

class Filesystem implements FilesystemPackage
{

	protected static $instance = null;

	protected $input = [];
	protected $raw;
	protected $type;

	public function __construct( $root = null ) {

		self::$instance = $this;

		$this->factory = new FilesystemFactory;
		$this->type = new FilesystemTypeHelper;

		if ( $root ) {
			$this->input( $root );
		}

	}

	public static function getInstance()
	{

		return self::$instance ? self::$instance : new self;

	}

	public function input( $input )
	{

		$this->raw = $input;

		$name = FilesystemInput::normalize( $input );

		if ( array_key_exists( $name, $this->input ) ) {
			return $this->input[ $name ];
		}

		if ( ! $input instanceof FilesystemInput ) {

			if ( ! in_array( gettype( $input ), [ 'string', 'array' ] ) ) {
				throw new Exception( 'Input must be string or array' );
			}

			$input = new FilesystemInput( $input );

		}

		$this->input[$name] = $input;

		return $input;

	}

	public function scan( $input, array $filters = [] ) {

		$scan = [];
		$input = $this->input( $input );

		foreach ( scandir( $input->getString() ) as $key => $item ) {

			$item = $this->apply( $item, ...$filters );

			if ( $item ) {
				$scan[ $key ] = $item;
			}
		}

		return $scan;

	}

	public function apply( string $item, ...$filters ) {

		foreach ( $filters as $filter ) {
			$filter = $this->getFilter( $filter );

			$item = $filter( $item );
		}

		return $item;

	}

	public function getFilter( $filter ) {

		if ( ! $file instanceof FileystemFilterInterface ) {

			if ( is_string( $filter ) ) {
				if ( ! class_exists( $filter ) || ! in_array( __NAMESPACE__ . '\\' . 'FilesystemFilterInterface', class_implements( $filter ) ) ) {

					throw new OutOfBoundsException( 'Invalid filter' );
				}

				$filter = new $filter;

			} else {

				throw new Exception( 'Unknown filter type' );
			}

		}

		return $filter;

	}

	public function scanRecursive( $input, $filters = [], array $scan = null ) {

		$scan = (array) $scan;
		$input = $this->input( $input );

		foreach ( $this->scan( $input ) as $item ) {

			$dir = $input->getDirectory();
			$path = $dir . $item;

			if ( is_dir( $path ) ) {
				$scan = $this->scanRecursive( $path, $filters, $scan );
			}

			$scan[] = $path;
		}

		return $scan;

	}

	public function type()
	{

		return $this->type;

	}

	public static function typeStatic()
	{

		return self::getInstance()->type();

	}

	public function factory()
	{

		return $this->factory;

	}

	public static function factoryStatic()
	{

		return self::getInstance()->factory();

	}

/*
	public function scan( $readable, array $filters = [] ) {

		$scan = [];

		if ( is_array( $readable ) ) {
			$readable = $this->implode( $readable );
		}

		if ( ! is_readable( $readable ) ) {

			throw new Exception( 'Not readable for scan' );
		}

		foreach ( scandir( $readable ) as $key => $item ) {

			$item = $this->apply( $item, $filters );

			if ( $item ) {
				$scan[ $key ] = $item;
			}
		}

		$scan = array_values( $scan );

		return $scan;

	}

	public function apply( $item, array $filters )
	{

		if ( empty( $item ) ) {
			return;
		}

		foreach ( $filters as $filter ) {

			if ( is_string( $filter ) ) {
				if ( ! class_exists( $filter ) || ! in_array( __NAMESPACE__ . '\\' . 'FilesystemFilterInterface', class_implements( $filter ) ) ) {

					throw new OutOfBoundsException( 'Invalid filter' );
				}
				$filter = new $filter;
			}

			$item = $filter( $item );
		}

		return $item;

	}

	public function structure( $input ) {

		$array = [];

		$input = $this->input( $input );

		$scan = $this->scan( $input

*/
}
