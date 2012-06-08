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
    include_once('view.inc.php');

    class request{

        private $uri;
        private $view;
        private $controller;
        private $params;

        public function __construct(){
            $this->params = Array();
        }
        public function __destruct(){
            foreach( $this->params as $key=>&$value ){
                unset($this->params[$key]);
            }
            unset( $this->uri );
            unset( $this->view );
            unset( $this->controller );
            unset( $this->params );
        }

        public function add_param($key, $value){
            /*
                @ param          Set value in element of params array.
            */
            if(!empty($key)){
                $this->params[$key] = $value;
            }
        }
        public function add_params($method, $param, $value){
            /*
             *       @ param          Set value in element of params array.
             */
            $this->params[$method][$param] = $value;
        }
        public function get_param($key){
            /*
                @ param          Set value in element of session array.
            */
            if(array_key_exists($key, $this->params)){
                return $this->params[$key];
            }
        }
        public function get_uri(){
            /*
                @ return          Return requested URI
            */
            return $this->uri;
        }
        public function set_uri($uri){
            /*
                @ param         Set requested URI value
            */
            $this->uri = $uri;
        }
        public function set_view($view){
            /*
                @ param         Set requested view object
            */
            $this->view = $view;
        }
        public function get_view(){
            /*
                @ return          Return requested VIEW
            */
            return $this->view;
        }
        public function get_controller(){
            /*
                @ return          Return requested CONTROlLER
            */
            return $this->controller;
        }
        public function set_controller($controller){
            $this->controller = $controller;
        }
        public function get_params(){
            return $this->params;
        }
    }
?>
