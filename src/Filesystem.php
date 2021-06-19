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
	protected $match = [];

	protected $factory;
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

		if ( ! $input instanceof FilesystemInput ) {
			$input = $this->factory( 'Input', [ $input ] );
		}

		$name = $input->getName();
		if ( array_key_exists( $name, $this->input ) ) {
			$input = $this->input[ $name ];
		}

		$this->input[ $name ] = $input;

		return $input;

	}

	public function search( $string )
	{

		$matches = [];

		$input = $this->input( $string );

		$normal = $input->getNormal();
		if ( array_key_exists( $normal, $this->match ) ) {

			$matches = $this->match[ $normal ];

		} else {

			foreach ( $this->input as $input ) {

				if ( $input->compare( $string ) ) {

					$this->match[ $string ] = $input;
					$matches[] = $input;
				}
			}
		}

		return $matches;

	}

	public function scan( $input, array $filters = [] )
	{

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

	public function apply( string $item, ...$filters )
	{

		foreach ( $filters as $filter ) {
			$filter = $this->getFilter( $filter );

			$item = $filter( $item );
		}

		return $item;

	}

	public function getFilter( $filter )
	{

		if ( ! $file instanceof FileystemFilterInterface ) {

			if ( is_string( $filter ) ) {
				if ( ! class_exists( $filter ) || ! in_array( __NAMESPACE__ . '\\' . 'FilesystemFilterInterface', class_implements( $filter ) ) ) {

					throw new OutOfBoundsException( 'Invalid filter' );
				}

				$filter = $this->factory( $filter );

			} else {

				throw new Exception( 'Unknown filter type' );
			}

		}

		return $filter;

	}

	public function scanRecursive( $input, $filters = [], array $scan = null )
	{

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

	public function factory( $alias = null, array $args = [] )
	{

		$obj = null;

		$factory = $this->factory;
		if ( is_null( $alias ) ) return $factory;

		if ( method_exists( $factory, 'create' . $alias ) ) {
			$methodName = 'create' . $alias;

			$obj = $factory->$methodName( ...array_values( $args ) );

		}

		return $obj;

	}

	public static function factoryStatic()
	{

		return self::getInstance()->factory();

	}

	public static function getNamespace()
	{

		return __NAMESPACE__;

	}

	public static function getPackage()
	{

		return 'Filesystem';

	}

}
