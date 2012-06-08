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
    class view {
        private $params;
        public function __construct($name){
            $this->params = Array();
            $this->set_view($name);
        }
        public function __destruct(){
            unset($this->params);
        }
        public function set_view($name){
            $this->params['name'] = $name;
        }
        public function toggle_error($code,&$params){
            $params->request->add_param('CODE',$code);
        }
        public function add_param($key, $value){
            /*
             *       @ param          Set value in element of params array.
             */
            if(!empty($key)){
                $this->params[$key] = $value;
            }
        }
        public function get_param($key){
            /*
             *       @ param          Set value in element of session array.
             */
            if(array_key_exists($key, $this->params)){
                return $this->params[$key];
            }
        }
        public function load($params){
            
            $this->config_view($params);
            
            try{                
                Utils::helper_load_view(
                    $this->get_param('name'),
                    $this->get_param('path'),
                    $params
                );
            }catch(Exception $ex) {
                throw new Exception($ex->getMessage());
            }
        }
        private function config_view($params){

            $_path = $params->config->get_param('PATHS');
            $_error = $params->request->get_params();

            if( !isset( $_error['CODE']  )){
                $this->add_param( 'path', $_path['views'] );
            }else{
                $this->add_param( 'name', $_error['CODE'] );
                $this->add_param( 'path', $_path['errors'] );
            }
        }
    }
?>
