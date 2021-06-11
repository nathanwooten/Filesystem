<?php

namespace nathanwooten\Filesystem;

interface FilesystemFilterInterface
{

	public function __invoke( $value );

}
