<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitScan
{

	use FilesystemTraitHelper;

	public function scan( $readable, array $filters = [] ) {

		if ( ! $readable ) {
			throw new Exception( 'Unreadable provided' );
		}

		$scan = $this->act( __TRAIT__, __FUNCTION__, ...func_get_args() );
		return $scan;

	}

	public function structure( $readable, array $filters = [] ) {

		if ( ! $readable ) {
			throw new Exception( 'Unreadable provided' );
		}

		$scan = $this->act( __TRAIT__, __FUNCTION__, ...func_get_args() );

		return $scan;

	}

}
