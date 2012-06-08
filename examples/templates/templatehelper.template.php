<php? $data = $CONTEXT->get_params(); ?>
<html>
    <?php 
        if ( $data['exists'] ):
            print($data['head']);
            print($data['body']); 
        else: ?>
            <head>
                <title>Required template does not exists</title>
            </head>
            <body>
                <p>Required template does not exists</p>
            </body>
  <?php endif; ?>
</html>