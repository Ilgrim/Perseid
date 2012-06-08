<?php
    /*
        Copyright (c) <2011-2012>, <Jose Alvaro Dominguez devlon_delander@gmx.es>
        All rights reserved.

        Redistribution and use in source and binary forms, with or without
        modification, are permitted provided that the following conditions are met:
        * Redistributions of source code must retain the above copyright
          notice, this list of conditions and the following disclaimer.
        * Redistributions in binary form must reproduce the above copyright
          notice, this list of conditions and the following disclaimer in the
          documentation and/or other materials provided with the distribution.
        * Neither the name of the <organization> nor the
          names of its contributors may be used to endorse or promote products
          derived from this software without specific prior written permission.

        THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
        ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
        WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
        DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
        DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
        (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
        LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
        ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
        (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
        SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
    */
    include_once(dirname(__FILE__).'/../core/interfaces/ihook.inc.php');

    class runner implements ihook{
            function __construct(){
            }
            function __destruct(){
            }
            /********************************************************+*************
            *
            *   Execute method is called by Dispatcher for invoke mapped Controller
            *   The Controller, will make changes on context.
            *
            ********************************************************+*************/

            function execute(&$context){
                $controller = $this->load_controller($context);
                if(isset($controller)){
                    $controller->execute($context);
                }
            }
            function load_controller($context){
                // Get an Assoc array of config
                $paths = $context->config->get_param('PATHS');
                return  Utils::helper_class_invoker(
                   $context->request->get_controller(),
                    $paths['controllers']
                );
            }
    }
?>
