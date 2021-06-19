# Filesystem

```php
$dir = 'C:\nathanwooten\Operation\Violet\HomeBranch\Profordable\Projects\simplewebsite\Dev\Home\src';
$filesystem = new nathanwooten\Filesystem\Filesystem( $dir );

$input = $filesystem->input( $dir );
var_dump( $input );

$filesystem = new nathanwooten\Filesystem\Filesystem( $dir );
var_dump( $filesystem );

$filesystem = new nathanwooten\Filesystem\Filesystem( explode( '\\', $dir ) );
var_dump( $filesystem );

$filesystem = new nathanwooten\Filesystem\Filesystem( new nathanwooten\Filesystem\FilesystemInput( $dir ) );
var_dump( $filesystem );
```
