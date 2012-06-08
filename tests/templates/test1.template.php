<html>
    <head>
    </head>
    <body>

        <form action="/cosas1" method="POST">
            <input type="text" name="user_n "/>
            <input type="password" name="pass_p" />
            <input type="submit" />
        </form>
        <hr />

        <?php
        /*
         *      Testing Context values. $CONTEXT comes from $view->load()
         */
            var_dump($CONTEXT);
        ?>

    </body>
</html>