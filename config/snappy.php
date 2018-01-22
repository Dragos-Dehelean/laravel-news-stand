<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => '"C:\xampp\htdocs\laravel5_4\vendor\h4cc\wkhtmltopdf-i386\bin\wkhtmltopdf-i386"',       
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
