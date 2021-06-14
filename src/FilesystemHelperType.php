<?php

namespace nathanwooten\Filesystem;

use nathanwooten\FilesystemFactory;

class FilesystemHelperType
{

	use FilesystemTrait;
	use FilesystemTraitFactory;

	public function fromInput( $input, $type )
	{

		$value = $input->normalize( $type );
		return $value;

	}

	public function toInput( $item ) {

		$input = $this->factory()->createInput( $item );
		return $input;

	}

	public function getAlias( $qualified ) {

		if ( ! class_exists( $qualified ) ) {
			throw new Exception( 'Please provide a qualified' );
		}

		$alias = str_replace( $this->getNamespace() . '\\' . $this->getPackage(), '', $qualified );
		return $alias;

	}

	public function qualify( $alias ) {

		$qualified = $this->getNamespace() . '\\' . $this->getPackage() . $alias;

		if ( ! class_exists( $qualified ) ) {
			throw new Exception( 'Please provide a valid alias' );
		}

		return $qualified;

	}

	public function isA( $data, $alias ) {

		$interface = $this->qualify( $alias );

		$isA = is_a( $data, $interface );
		return $isA;

	}

	public function hasExtension( $file )
	{

		$pos = strpos( $file, '.' );

		if ( false !== $pos ) {
			$sepPos = strpos( $file, DIRECTORY_SEPARATOR );

			if ( $pos > $sepPos ) {
				return true;
			}
		}

		return false;

	}

	public function getNamespace() {

		return Filesystem::getNamespace();

	}

	public function getPackage()
	{

		return Filesystem::getPackage();

	}

}
