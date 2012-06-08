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
    class Utils{
        public static function helper_file_invoker($name, $path, $CONTEXT=Null){
            $_file = "$path/$name";
            if(file_exists($_file)){
                if(include($_file) ){
                    return true;
                }
            }else{
                throw new Exception('File not found');
            }
        }
        public static function helper_class_invoker($name, $path){
            try{
                if(file_exists("$path/$name.inc.php")){
                    if(include_once($path."/".$name.".inc.php")){
                        return new $name;
                    }
                }else{
                    return Null;
                }
            }catch(Exception $ex) {
                echo ":: Error importing Class >> $path";
            }
        }
        public static function helper_load_view($name, $path, $CONTEXT){
            try{
                $name .='.template.php';
                self::helper_file_invoker($name,$path, $CONTEXT);
            }catch( Exception $ex){
                throw new Exception("Template [ $path/$name ] cannot be loaded");
            }
        }
        
        public static function sanitize($string){
            return  htmlentities( trim($string) );
        }
        
        public static function authenticate($context){
            $_auth = $context->config->get_param('AUTH');
            $_path = $context->config->get_param('PATHS');
            
            $_manager = Utils::helper_class_invoker(
                                                $_auth['manager'], 
                                                $_path['managers']
            );
            
            return $_manager->authenticate($context);
        }
    }
?>
