<?php
/**
 * 
 * Auto load all the files which are instantiated
 * 
 * @return void
 */
spl_autoload_register( 'exad_autoload_classes' );

function exad_autoload_classes( $class ) {
    
    $prefix = 'ExclusiveAddons\Elements\\';

    // base directory for the namespace prefix
    $base_dir = EXAD_PATH . 'elements/';

    $length = strlen($prefix);
    if (strncmp($prefix, $class, $length) !== 0) {
        return;
    }

	$relative_class = substr($class, $length);
	$relative_class = str_replace( '_', '-', $relative_class );
	$relative_class = strtolower( $relative_class );
	$class_file = str_replace('\\', '/', $relative_class);

	$file = $base_dir . $class_file . DIRECTORY_SEPARATOR . $class_file . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
    
}
