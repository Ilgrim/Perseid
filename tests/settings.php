<?php
   $CONFIG = Array(
                'URLS' => Array(
                        "/^\//i" => Array(
                                    'controller' => 'controller1',
                                    'view' => 'test1',
                                    
                                    // Optional Parameter
                                    'properties' => Array (
                                        'login' => true,
                                        'cache' => false
                                    ),
                        ),
                        
                        // Advanced patterns example.Checks this type of url:
                        //         http://example.com/thing/text/othertext/0001
                        "/^\/thing\/(\w+)\/(\w+)\/(\d+)/i" => Array(
                            'controller' => 'main',
                            'view' => 'section_view',
                        ),
                 ),
                 'PATHS' => Array(
                     'lib' => '../lib',
                     'views' => 'templates',
                     'controllers' => 'controllers',
                     'hooks' => '../lib/hooks',
                     
                     // Optional Parameter
                     'managers' => '../lib/managers',
                     'errors' =>'../lib/views/error/',
                 ),
                 
                 // Optional section. 
                 //    (Required by Auth hook and htdigest manager)
                 'AUTH' => Array(
                     'manager' => 'auth/htdigest',
                     'authfile' => '/tmp/auth.db',
                 ),
    );
?>
