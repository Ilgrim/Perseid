<?php
    /*
     @author Juan Manuel Pérez
   
    This class is an help for make a the page layout or debuging it.
    A designer cuouldn't make the layout with variables and a minimal 
    operational controller.

     This class opens the php files and if it's find some "include" sentence, it 
     will bring the pieces of code from a complete View and show all of them.
    */
    class templater extends controller {

      public function __contruct() {
        parent::__contruct();
      }

      public function __destruct() {
        parent::__destruct();
      }

      public function execute(&$context) {

        $file = $_SERVER["DOCUMENT_ROOT"] . $context->request->get_uri() . '.template.php';
        $context->add_param('exists', is_file($file));

        if (is_file($file)) {
          $reader = fopen($file, 'r');
          $data = fread($reader, filesize($file));
          fclose($reader);

          $data = $this->includeIncludes($data);

          $context->add_param('head', $this->splitHead($data));

          $context->add_param('body', $this->splitBody($data));
        }
      }

      private function includeIncludes($data) {
        $returner = $data; // Final HTML to show

        /* A normal templates could be cut like, for example:
         * <? require('header.php'); ?>
         * <!-- Add here your HTML view -->
         * <? require('footer.php'); ?>
         * 
         * This script also reads recursively
         * 
         * So this controller will look for <? require('header.php'); ?> until there's no one. and import them.
         * It's for personal use so it only understand MY programming style.
         * It will ONLY include files IF AND ONLY IF has this structure <? include('filetoinclude.php'); ?>
         */
        while (strpos($returner, '<? require(') || strpos($returner, '<? include(')) {
          //split on include( plus one char: ' or "
          $chunks = preg_split('#(<\?\ include\(.)#', $returner);
          //First chunk has not started by include( so there is no need to llok for files (or it's empty)
          $returner = array_shift($chunks);
          // Rest of chunks start by files that need to be included.
          foreach ($chunks as $chunk) {
            $file = substr($chunk, 0, strpos($chunk, '); ?>') - 1);
            if ($file[0] == '/') { //absolute path
              if (is_file($file) && is_readable($file)) {
                $returner .= file_get_contents($file);
              }
            }
            if (preg_match('#^$_SERVER\[.DOCUMENT_ROOT.\]#', $file) == 1) { //absolute path
              $file = eval($file);
              if (is_file($file) && is_readable($file)) {
                $returner .= file_get_contents($file);
              }
            } else { //relative path from templates folder
              $file = $_SERVER['DOCUMENT_ROOT'] . 'templates/' . $file;
              if (is_file($file) && is_readable($file)) {
                $returner .= file_get_contents($file);
              } else {
                $returner .= 'Could not import "' . $file . '"';
              }
            }
            $returner .= substr($chunk, strpos($chunk, '?>') + 2);
          }
        }

        return $returner;
      }

      private function splitHead($data) {
        $returner = ""; //this is the varible we'll return.
        //string sholud start when <head>
        $returner = substr($data, strpos($data, '<head>'));
        //now we have all from <head> to End Of file
        //cutting at the end of </head>
        $returner = substr($returner, 0, strpos($returner, '</head>') + strlen('</head>'));
        /* Meaybe there are <? ?> tags on <head> but php secure it on print();
         * replacing <? ?> with <!--? ?--> (HTML comments)
         * We only have to return the head tag */
        return $returner;
      }

      private function splitBody($data) {
        $returner = ""; //this is the varible we'll return.
        //string sholud start when <body>
        $returner = substr($data, strpos($data, '<body>'));
        //now we have all from <body> to End Of file
        //cutting at the end of </body>
        $returner = substr($returner, 0, strpos($returner, '</body>') + strlen('</body>'));
        /* Maybe there are <? ?> tags on <head> but php secure it on print();
         * replacing <? ?> with <!--? ?--> (HTML comments)
         * We have to replace to HTML elements in order to be see on template */
        $returner = str_replace('<?', '&lt?', $returner);
        $returner = str_replace('?>', '?&gt;', $returner);
        return $returner;
      }

    }
?>