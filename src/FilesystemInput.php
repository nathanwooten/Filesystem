<?php

namespace nathanwooten\Filesystem;

use Exception;

class FilesystemInput {

	public $input;

	public function __construct( $input ) {

		self::isValidInput( $input );

		$this->input = $input;

	}

	public function getInput()
	{

		return $this->input;

	}

	public function getNormal()
	{

		return normal( $this->getInput() );

	}

	public static function isValidInput( $mixed )
	{

		if ( ! in_array( gettype( $mixed ), [ 'string', 'array' ] ) ) {
			throw new Exception( 'Invalid input' );
		}

	}

}
