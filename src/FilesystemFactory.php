<?php

namespace nathanwooten\Filesystem;

use Exception;

abstract class FilesystemFactoryAbstract implements FilesystemPackage
{

	use FilesystemTrait;

}

class FilesystemFactory extends FilesystemFactoryAbstract {

	protected $name = 'factory';

	public function createInput( $directory )
	{

		$inputObject = $this->create( 'Input', [ $directory ] );
		return $inputObject;

	}

	public function createSpl( $item ) {

		$item = $this->normalize( $item );

		$spl = $this->create( '\SplFileInfo', $item );
		return $spl;

	}

	protected function create( $class, array $args = null )
	{

		$class = $this->toClass( $class );
		if ( ! $class ) {
			throw new Exception( 'Unable to convert provided to qualified classname' );
		}

		$obj = new $class( ...array_values( (array) $args ) );
		return $obj;

	}

	public function toClass( string $string ) {

		if ( class_exists( $string ) ) {
			return $string;
		}
var_dump( $string );
		$class = $this->qualify( $string );
		if ( class_exists( $class ) ) {
			return $class;
		}
var_dump( 'da da da da' );
		return false;

	}

	public function toInput( $mixed ) {

		return $this->createInput( $mixed );

	}

	public function getNamespace()
	{

		return $this->filesystem()->getNamespace();

	}

	public function getPackage()
	{

		return $this->filesystem()->getPackage();

	}

	public function getName()
	{

		return $this->name;

	}

	public function has( $input )
	{

		return $this->filesystem()->hasInput( $input );

	}

	public function normalize( $item ) {

		$item = FilesystemInput::normalize( $item );
		return $item;

	}

	public function qualify( $alias )
	{
var_dump( $this->filesystem()->type() );
		return $this->filesystem()->type()->qualify( $alias );

	}

}
