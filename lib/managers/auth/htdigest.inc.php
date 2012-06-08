<?php
    /*
     *  Copyright (c) <2012>, <Jose Alvaro Dominguez devlon_delander@gmx.es>
     *  All rights reserved.
     * 
     *  Redistribution and use in source and binary forms, with or without
     *  modification, are permitted provided that the following conditions are met:
     * Redistributions of source code must retain the above copyright
     *    notice, this list of conditions and the following disclaimer.
     * Redistributions in binary form must reproduce the above copyright
     *    notice, this list of conditions and the following disclaimer in the
     *    documentation and/or other materials provided with the distribution.
     * Neither the name of the <organization> nor the
     *    names of its contributors may be used to endorse or promote products
     *    derived from this software without specific prior written permission.
     * 
     *  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
     *  ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
     *  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
     *  DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
     *  DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
     *  (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
     *  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
     *  ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
     *  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
     *  SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
     */

    class htdigest{
        // Very very simple example of manager for Auth hook using
        // Utils::autenticate.
        // Read a htdigest file, processes it and evaluates credentials.
        
        function __construct(){}
        public function authenticate($context){
            $found = false;
            
            // Get Auth file defined in $CONFIG and read it.
            $_conf = $context->config->get_param('AUTH');
            $_vlines = file( $conf['authfile'] ); 
            
            $_user = $context->get_param('user');
            $_pass = $context->get_param('pass');
            
            // Search User/Password and check with file credentials. 
            //  Return true if all is fine.
            
            // Example htdigest line >>        user:REALM:Pass_in_md5
            foreach ($_vlines as $line){
                // Get user and pass. ignoring realm.
                $_values = explode(':',$line);
                if( $_values[0] === $_user && 
                    $_values[2] === md5($_pass) ){
                        $found = true;
                }
            } 

            return $found;
            
        }
    }
?>