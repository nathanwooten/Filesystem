<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemTrait

};

use Exception;

class FilesystemInput
{

	use FilesystemTrait;

	protected $input;

	public function __construct( $input ) {

		$this->input = $input;

	}

	public function compare( $subject ) {

		if ( is_object( $subject ) || ( ! is_array( $subject ) && ! is_string( $subject ) ) ) {
			throw new Exception( 'Please provide a string or an array' );
		}

		if ( $subject === $this->getInput() ) {
			return true;
		}

		$subject = $this->normalize( $subject );

		if ( $subject === $this->getNormal() ) {
			return true;
		}

		if ( $this->strpos_( $this->input, $subject ) ) {
			return true;
		}

		return false;

	}

	public function getInput()
	{

		return $this->input;

	}

	public function getName()
	{

		return $this->getString();

	}

	public function getNormal()
	{

		return $this->getName();

	}

	public function getString( $input = null )
	{

		$input = $input ? $input : $this->getInput();

		if ( ! is_string( $input ) ) {

			if ( ! is_array( $input ) ) {
				throw new Exception( 'Unknown input type, expecting array' );
			}

			foreach ( $input as $key => $item ) {
				$input[ $key ] = self::norm( $item, $key );
			}

			$input = implode( '', $input );
		}

		return $input;

	}

	public function getArray( $input = null )
	{

		$input = $input ? $input : $this->getInput();

		if ( ! is_array( $input ) ) {

			if ( ! is_string( $input ) ) {
				throw new Exception( 'Unknown input type, expecting string' );
			}

			$input = self::norm( $input );

				$separator = $this->getSeparator();
			$input = explode( $separator, ltrim( $input, $separator ) );

		}

		return $input;

	}

	public function getDirectory()
	{

		return dirname( $this->filesystem()->type()->toString( $this->input ) ) . DIRECTORY_SEPARATOR;

	}

	public static function normalize( $input )
	{

		$normalized = [];

		if ( $input instanceof FilesystemInput ) {
			$input = $input->getInput();
		}

		if ( ! in_array( gettype( $input ), [ 'string', 'array' ] ) ) {
			throw new Exception( 'Only normalizing strings and arrays' );
		}

		$input = (array) $input;
		$input = array_values( $input );

		foreach ( $input as $key => $item ) {

			$item = self::norm( $item, $key );

			$normalized[ $key ] = $item;
		}

		$normalized = implode( '', $normalized );

		return $normalized;

	}

	protected static function norm( string $item, int $key ) {

		$replace = self::getReplace();
		$separator = self::getSeparator();

		$item = str_replace( $replace, $separator, $item );
		$item = 0 < $key ? ltrim( $item, $separator ) : $item;

		if ( ! Filesystem::getInstance()->type()->hasExtension( $item ) ) {
			$item = rtrim( $item, $separator ) . $separator;
		}

		return $item;

	}

	public function strpos_( $haystack, $needle )
	{

		return $this->filesystem()->type()->strpos_( $haystack, $needle );

	}

	public static function getReplace()
	{

		return [ '\\', '/' ];

	}

	public static function getSeparator()
	{

		return DIRECTORY_SEPARATOR;

	}

}
