<?php

namespace nathanwooten\Filesystem;

interface FilesystemFilter
{

	public function __invoke( $value );

}
