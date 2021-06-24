<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemFunctionTraitApplyFilters,
	FilesystemFunctionTraitApplyFiltersItem,
	FilesystemFunctionTraitGetFilter,
	FilesystemFunctionTraitGetNamespace,
	FilesystemFunctionTraitGetReplace,
	FilesystemFunctionTraitGetSeparator,
	FilesystemFunctionTraitHasExtension,
	FilesystemFunctionTraitIsName,
	FilesystemFunctionTraitNormalize,
	FilesystemFunctionTraitQualify,
	FilesystemFunctionTraitScan,
	FilesystemFunctionTraitStrpos

};

trait FilesystemFunctionTrait {

	use FilesystemFunctionTraitApplyFilters,
	use FilesystemFunctionTraitApplyFiltersItem,
	use FilesystemFunctionTraitGetFilter,
	use FilesystemFunctionTraitGetNamespace,
	use FilesystemFunctionTraitGetReplace,
	use FilesystemFunctionTraitGetSeparator,
	use FilesystemFunctionTraitHasExtension,
	use FilesystemFunctionTraitIsName,
	use FilesystemFunctionTraitNormalize,
	use FilesystemFunctionTraitQualify,
	use FilesystemFunctionTraitScan,
	use FilesystemFunctionTraitStrpos

}
