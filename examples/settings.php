<?

    $CONFIG = Array(
        'URLS' => Array(
            
            // Simple example of URL routing.
            "#^/#" => Array(
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
            
            // This is an example to control all URLs of a gallery using Perseid
            // instead of .htaccess
            // Get http://example.com/images/24.jpg
            "#^/images/#i" => Array(
                'controller' => 'gallery',
                'view' => 'gallery'
                ),
            // This one stream the image raw data.    
            "#^/raw/#i" => Array(
                'controller' => 'rawoutput',
                'view' => 'rawoutput'
            ),
            
            "#^/lib/.*|^/images/$|^/controllers/#i" => Array(
                'view' => '403'
            ),
            // This is an example of a template viewer. Useful for debug and 
            // layout.
            "#^/templates/#i" => Array(
                'controller' => 'templatehelper',
                'view' => 'templatehelper'
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
        
        // Optional section. (Required by Auth hook)
        'AUTH' => Array(
            'manager' => 'auth/htdigest',
            'authfile' => '/tmp/auth.db',
        ),
    );
?>
