<?php

namespace nathanwooten\Filesystem;

class FilesystemHelperClassname
{

	public function toAlias( $qualified ) {

		if ( ! class_exists( $qualified ) ) {
			throw new Exception( 'Please provide a qualified' );
		}

		$alias = str_replace( $this->getNamespace() . '\\' . $this->getPackage(), '', $qualified );
		return $alias;

	}

	public function fromAlias( $alias ) {

		$qualified = $this->getNamespace() . '\\' . $this->getPackage() . $alias;

		if ( ! class_exists( $qualified ) ) {
			throw new Exception( 'Please provide a valid alias' );
		}

		return $qualified;

	}

	public function getNamespace() {

		return __NAMESPACE__;

	}

	public function getPackage()
	{

		return 'Filesystem';

	}

}
