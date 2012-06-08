<html>
    <head>
    </head>
    <body>
        <?php $dat = $CONTEXT->get_params() ?>
        <table>
            <?php foreach($dat['GET'] as $key => $item): ?>

                <tr>
                    <td> <?php echo $key ?></td>
                    <td> <?php echo $item ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </body>
</html>
