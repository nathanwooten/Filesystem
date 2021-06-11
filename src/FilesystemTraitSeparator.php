<?php

namespace nathanwooten\Filesystem;

trait FilesystemTraitSeparator {

	protected $separator;

	public function setSeparator( $separator )
	{

		$this->separator = $separator;

	}

	public function getSeparator( $separator = null )
	{

		return $separator ? $separator : $this->separator;

	}

}
