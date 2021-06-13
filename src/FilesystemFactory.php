<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	Filesystem,
	FilesystemDirectory,
	FilesystemInput,
	FilesystemTrait,
	FilesystemTraitClassname,
	FilesystemTraitInput

};

abstract class FilesystemFactoryAbstract extends FilesystemPackageInterface
{

	use FilesystemTrait;
	use FilesystemTraitClassname;
	use FilesystemTraitInput;

}

class FilesystemFactory extends FilesystemFactoryAbstract {

	public function createDirectory( $directory )
	{

		if ( ! $this->filesystem()->has( $directory ) ) {

			$input = $this->toInput( $directory );

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

	public function toClass( $mixed ) {

		if ( class_exists( $mixed ) ) {
			return $mixed;
		}

		$class = $this->fromAlias( $mixed );
		if ( class_exists( $class ) ) {
			return $class;
		}

		return false;

	}

	public function getNamespace()
	{

		return __NAMESPACE__;

	}

}
