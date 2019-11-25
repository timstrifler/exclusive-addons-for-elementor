<?php
/**
 * 
 * Auto load all the files which are instantiated
 * 
 * @return void
 */
spl_autoload_register( 'exad_autoload_classes' );

function exad_autoload_classes( $class ) {
    // project-specific namespace prefix
    $prefix = 'ExclusiveAddons\Elementor\\';

    // base directory for the namespace prefix
    $base_dir = EXAD_PATH . 'elements/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
	$relative_class = substr($class, $len);
	$relative_class = str_replace( '_', '-', $relative_class );
	$relative_class = strtolower( $relative_class );
	$class_file = str_replace('\\', '/', $relative_class);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
	$file = $base_dir . $class_file . DIRECTORY_SEPARATOR . $class_file . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
    
}
