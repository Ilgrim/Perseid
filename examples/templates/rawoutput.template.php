<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, no-cache,must-revalidate");
header("Cache-Control: post-check=0, pre-check=0",false);
header("Pragma: no-cache");

$data = $CONTEXT->get_params();
header("Content-type: ".$data['mime']);

@readfile($data['file']);
?>
