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



    class session{
        public function __construct(){
            session_start();
        }
        public function __destruct(){}
        public function destroy(){
            foreach($_SESSION as $key=>&$value){
                unset( $_SESSION[$key] );
            }
            session_destroy();
        }
        public function get_id(){
            return session_id();
        }
        public function get_user(){
            return $_SESSION['user'];
        }
        public function get_ip(){
            return $_SESSION['remoteip'];
        }
        public function get_agent(){
            return $_SESSION['remoteagent'];
        }
        public function set_user($val){
            $this->add_param('user', $val);
        }
        public function set_ip($val){
            $this->add_param('remoteip', $val);
        }
        public function set_agent($val){
            $this->add_param('remoteagent', $val);
        }
        public function add_param($key, $val){
            $_SESSION[$key] = $val;
        }
        public function get_param($key){
            if(array_key_exists($key, $_SESSION)){
                return $_SESSION[$key];
            }
        }
    }
?>
