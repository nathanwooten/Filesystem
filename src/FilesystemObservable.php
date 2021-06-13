<?php

namespace nathanwooten\Filesystem;

class FilesystemObservable
{

	public $observable;


	public function __construct( $observable ) {

		$this->observable = $observable;

	}

	public function attach( $observer ) {

		$this->observers[] = $observer;

	}

	public function dettach( $name ) {

		foreach ( $this->observers as $key => $observer ) {

			$obsName = $this->getName( $observer );
			if ( $name === $obsName ) {
				unset( $this->observers[ $key ] );
			}
		}

	}

	public function getName( $observer ) {

		$name = $observer->getName();
		return $name;

	}

}
