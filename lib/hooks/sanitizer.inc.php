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

    class sanitizer implements ihook{
        
        function __construct(){
        }
        function __destruct(){
        }
        function execute(&$context){
            // Allowed methods.
            $methods = Array(
                                'GET' => $_GET,
                                'POST' => $_POST,
            );
            // Clean all data from Allowed methods and the requested URI.
            $uri = explode('?',$_SERVER['REQUEST_URI']);
            $context->request->set_uri(
                                    Utils::sanitize(
                                        $uri[0]
                                    )
            );
            foreach($methods as $method => &$array){
                $clean = $this->get_request($array);
                foreach($clean as $param => $value) {
                    $context->request->add_params($method, $param, $value);
                }
            }
            unset($uri);
        }
        private function get_request($array){
            $params = Array();
            foreach($array as $key => $value){
                $key = Utils::sanitize($key);
                $value = Utils::sanitize($value);
                $params[$key] = $value;
            }
            return $params;
        }
    }
?>
