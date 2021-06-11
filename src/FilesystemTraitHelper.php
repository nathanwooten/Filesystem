<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitHelper {

	public function act( string $trait, string $methodName, ...$args ) {

		$helper = $this->getHelper( $trait );
		if ( ! $helper ) {
			throw new Exception( 'Could not fetch helper' );
		}

		if ( method_exists( $helper, $methodName ) ) {

			return $helper->$methodName( ...$args );
		}

	}

	public function getHelper( string $trait )
	{

		$helperClass = str_replace( 'Trait', 'Helper', $trait );
		if ( ! class_exists( $helperClass ) ) {
			throw new Exception( 'Class does not exists' );
		}

		return new $helperClass;

	}

	public function getName( string $trait )
	{

		$name = str_replace( __NAMESPACE__ . '\\' . 'FilesystemTrait', '', $trait );
		$name = strtolower( $name );

		return $name;

	}

}

?>