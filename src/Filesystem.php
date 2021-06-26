<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\Traits\{

	FilesystemFunctionTrait,

};

use function nathanwooten\Filesystem\Functions\{

	is_name,
	normalize,

};

class Filesystem
{

	use FilesystemFunctionTrait;

	protected $abspath;
	protected $filesystem = [];
	protected $result = [];

	public function __construct( $abspath )
	{

		$this->abspath = $abspath;

		$this->filesystem = $this->scan( $this->abspath, [ 'File' ] );

	}

	public function get( $input ) {

		$input = self::handleInput( $input );

		if ( ! array_key_exists( $input, $this->result ) ) {

			$result = new FilesystemSearchResult( $input );

			foreach ( $this->filesystem as $path ) {

				if ( false !== $this->strpos_( $path, $input ) ) {

					$result->addResult( $path );
				}
			}

			$this->result[ $input ] = $result;
		}

		return $this->result[ $input ];

	}

	public static function handleInput( $input ) {

		if ( $input instanceof FilesystemInput ) {

			$input = $input->getNormal();

		} else {

			$input = new FilesystemInput( $input );

			$input = $input->getNormal( $input );
//			$input = is_name( $input->getInput() ) ? $input->getInput() : $input->getNormal( $input );
		}

		return $input;

	}

}

/*
use function gettype;

interface FilesystemPackage {

	public function getName();

}

class FilesystemIterator
{
/*
	const ON = 0;
	const IN = 1;
//

	protected $item;
	protected $pointer = 0;

	public function __construct( FilesystemDirectory $item ) {

		$this->item = $item;

	}

	public function getItem()
	{

		return $this->item;

	}

	public function getPrev()
	{

		return $this->getItem()->getParent();

	}

	public function getNext()
	{

		return $this->getItem()->getNext();

	}


/*
	public function add()
	{

		$pointer = $this->pointer;

		if ( false === strpos( $pointer, '.' ) ) {
			if ( $pointer < 0 ) {
				throw new Exception;
			}
			$pointer++;
			return $pointer;
		}

		$dotted = array_reverse( explode( '.', $pointer ) );

		


	}
*/
/*
	public function getParent()
	{

		$item = $this->item;
		$parent = $this->getItem()->getParent();
		return $parent;

	}

	public function getPrev()
	{

		if ( 0 === $this->getItem()->key() ) {
			$this->getItem()->getParent();
		} else {
			$this->getItem()->prev();
		}

		$this->advance();

	}

	public function getNext()
	{

		return $this->getItem->getNext();

	}
*/
/*
	public function getNext()
	{

		if ( static::ON === $this->getStatus() ) {
			$next = $this->getDirectory()
			$this->setStatus( static::IN );
			return $next;
		}

		if ( static::IN === $this->getStatus() ) {
			$next = next( $this->directory_->children );
			if ( ! $next ) {
				$this->
			}

			return $next;
		}

		throw new Excpetion( 'Unknown status' );

	}
*/
/*
}
/*
class FilesystemDirectory implements FilesystemPackage
{

	protected $children = [];
	protected $input;
	protected $parent = null;

	public function __construct( $input, FilesystemDirectory $parent = null )
	{

		$this->input = $this->normal = Filesystem::handleInput( $input );
		$this->children = scan( $this->normal );

		if ( ! is_null( $parent ) ) {
			$this->parent = $parent;
		}

	}

	public function getName() {

		$explode = explode( DIRECTORY_SEPARATOR, trim( $this->getNormal(), DIRECTORY_SEPARATOR ) );
		$name = array_pop( $explode );
		return $name;

	}

	public function getNormal() {

		return $this->normal;

	}

	public function getPrev()
	{

		return prev( $this->children );

	}

	public function getNext()
	{

		return next( $this->children );

	}

	public function reset()
	{

		reset( $this->children );

	}

}

class FilesystemFile {

	public function __construct( $input )
	{

		$this->input = Filesystem::handleInput( $input );

	}

}

class FilesystemInput implements FilesystemPackage
{

	protected $input;

	public function __construct( $input ) {

		$this->input = $input;

	}

	public function getInput()
	{

		return $this->input;

	}

	public function getNormal()
	{

		$input = $this->getInput();
		$normal = normalize( $input );
		return $normal;

	}

	public function getName()
	{

		return $this->getNormal();

	}

}

class Filesystem implements FilesystemPackage
{

	protected $filesystem = null;

	public function __construct( $input ) {

		$input = static::handleInput( $input );

		$this->filesystem = $this->createDirectory( $input );

	}

	public function getName() {

		return $this->filesystem->getString();

	}

	public static function handleInput( $input ) {

		if ( $input instanceof FilesystemInput ) {
			$input = $input->getInput();
		}

		if ( ! in_array( gettype( $input ), [ 'string', 'array' ] ) ) {
			throw new Exception( 'Bad type bad type bad' );
		}

		$input = normalize( $input );

		return $input;

	}

	protected function factory( $alias, $input ) {

		return $this->create( qualify( $alias ), $input );

	}

	protected function create( $class, $input )
	{

		if ( ! class_exists( $class ) ) {
			throw new Exception( 'Class does not exists' );
		}

		return new $class( ...array_values( (array) $input ) );

	}

	protected function createDirectory( $input ) {

		$input = static::handleInput( $input );
		$directory = $this->factory( 'Directory', $input );

		return $directory;

	}

}
*/
