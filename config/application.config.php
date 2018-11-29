<?php
return array(
    'modules' => array(
        'Application',
    ),
    'config_glob_paths' => array(
        'config/autoload/{{,*.}global,{,*.}local}.php',
    ),
    'module_listener_options' => array( 
        'config_cache_enabled' => false,
        'cache_dir'            => 'data/cache',
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
