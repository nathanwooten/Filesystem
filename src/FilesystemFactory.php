<?php

namespace nathanwooten\Filesystem;

use Exception;

abstract class FilesystemFactoryAbstract implements FilesystemPackage
{

	use FilesystemTrait;

}

class FilesystemFactory extends FilesystemFactoryAbstract {

	protected $name = 'factory';
/*
	public function createDirectory( $input )
	{

		$key = $this->hasInput( $input );
		if ( $key ) {
			$inputs = $this->filesystem()->getInput();
			$input = $inputs[ $key ];
		} else {
			$input = $this->getInput( $input );
		}






			$directory = $this->get( $input );
			return $directory;
		}

		if ( ! $this->filesystem()->hasInput( $input ) ) {

			if ( $input->isObject() ) {

				$directoryObject = $input->getObject();

			} else {

				$directoryObject = $this->create( 'Directory', $input );
			}
		} else {

			$directoryObject = $this->filesystem()->get( $directory );
		}

		return $directory;

	}
*/
	public function createInput( $directory )
	{

		$inputObject = $this->create( 'Input', [ $directory ] );
		return $inputObject;

	}

	public function createSpl( $item ) {

		$item = $this->normalize( $item, 'string', 'readable' );

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

		$class = $this->qualify( $string );
		if ( class_exists( $class ) ) {
			return $class;
		}

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

}
