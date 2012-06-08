<?php $data = $CONTEXT->get_params()?>
<html>
  <head></head>
  <body>
    <h1>Here is my super gallery</h1>
    <hr />
    <p>And the text for this photo is: <? print($data['text']) ?></p>
    <img src="<? print($data['img']) ?>">
  </body>
</html>