<?php

namespace nathanwooten\Filesystem;

class DirectionalIterator
{

	protected $input;
	protected $name;
	protected $normal;

	public function __construct( $directory ) {

		if ( ! $directory instanceof FilesystemInput ) {

			$directory = $this->factory()->createInput( $directory );
		}

		$this->input = $directory;

		$this->name = $this->input()->getName();
		$this->normal = $this->input()->getNormal( null, 'array' );

	}

}
