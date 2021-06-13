<?php

namespace nathanwooten\Filesytem;

class FilesystemHelperInput {

	public function fromInput( $input, $type )
	{

		$value = $input->normalize( $type );
		return $value;

	}

	public function toInput( $item ) {

		$input = $this->factory()->createInput( $item );
		return $input;

	}

}
