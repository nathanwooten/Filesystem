<?php

namespace nathanwooten\Filesystem;

use nathanwooten\FilesystemFactory;

class FilesystemTypeHelper implements FilesystemPackage
{

	use FilesystemTrait;

	public $name = 'typeHelper';

	public function fromInput( $input, $type )
	{

		$value = $input->getString();
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

		$prefix = $this->getNamespace() . '\\' . $this->getPackage();

		$alias = str_replace( $prefix, '', $qualified );
		return $alias;

	}

	public function qualify( string $alias ) {

		$prefix = $this->getNamespace() . '\\' . $this->getPackage();
		$qualified = $prefix . $alias;

		if ( class_exists( $qualified ) ) {
			return $qualified;
		}

		foreach ( [ 'Trait', 'Helper' ] as $type ) {

			$qualified = $prefix . $type . $alias;
			if ( class_exists( $qualified ) ) {
				return $qualified;
			}
		}

		throw new Exception( 'Unknow type error' );

	}

	public function isA( $data, $alias ) {

		$interface = $this->qualify( $alias );

		$isA = is_a( $data, $interface );
		return $isA;

	}

	public function isReadable( $data )
	{

		$root = $this->normalize( $this->root() );

		$readable = $root . $this->normalize( $data, 'toString' );
		if ( ! is_readable( $readable ) ) {

			return false;
		}

		return $readable;

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

	public function strpos_( $dir, $string )
	{

		return strpos( strtolower( $dir ), strtolower( $string ) );

	}

	public function getNamespace() {

		return Filesystem::getNamespace();

	}

	public function getPackage()
	{

		return Filesystem::getPackage();

	}

}
