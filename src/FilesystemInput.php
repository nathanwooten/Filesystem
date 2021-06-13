<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	Filesystem,
	FilesystemTrait,
	FilesystemTraitAlias,
	FilesystemTriatNormalize

};

class FilesystemInput
{

	use FilesystemTrait;
	use FilesystemTraitNormalize;
	use FilesystemObservable;

	protected $input;
	protected $normal = [];
	protected $type;

	public function __construct( $input )
	{

		$this->setInput( $input );

		$this->attach( Filesystem::getInstance() );

	}

	public function getName() {

		$normal = $this->getNormal();
		
		return array_pop( $normal );

	}

	public function getNormal( $type = 'string' )
	{

		if ( ! array_key_exists( $type, $this->normal ) && in_array( $type, 'string', 'array' ] ) ) {

			$this->normal[ $type ] = $this->createNormal( $type );
		}

		return $this->normal[ $type ];

	}

	public function getInput()
	{

		return $this->input;

	}

	public function setInput( $input )
	{

		$this->input = $input;

		$this->type = $this->getType_( $input );
		$this->normal = $this->normalize( $this->input, 'array' );

	}

	public function getType_( $input ) {

		$type = getType( $input );

		if ( 'object' !== $type ) {
			return $type;
		}

		return $this->toAlias( get_class( $input ) );

	}

	/**
	 * Available types are string and array
	 */

	protected function createNormal( $type = 'string' ) {

		return $this->normalize( $this->getInput(), $type );

	}

	public function __toString()
	{

		return $this->getName();

	}

}
