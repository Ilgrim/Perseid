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
    include_once(dirname(__FILE__).'/../core/view.inc.php');

    class beautifier implements ihook{

        private $aux;

        function __construct(){
            $this->aux = Null;
        }
        function __destruct(){
            foreach( $this->aux as $val ) {
                unset( $val );
            }


        }
        /**********************************************************************
        *
        *   Execute method is called by Dispatcher for invoke mapped Controller
        *   The Controller, will make changes on context.
        *
        **********************************************************************/

        function execute(&$context){

            $url = $context->request->get_uri();
            $conf = $context->config->get_param('URLS');

            foreach($conf as $pattern => $params){
                if(
                    preg_match(
                            "$pattern", "$url"
                    )
                ){
                    $context->request->set_view(
                                        new view(
                                            $conf[$pattern]['view']
                                        )
                    );
                    $context->request->set_controller(
                                        $conf[$pattern]['controller']
                    );
                    $context->request->add_param(
                                        'pattern',
                                        $pattern
                    );
                    $this->aux = preg_split($pattern,$url);
                }
            }
            $params = explode('/', $this->aux[1] );

            for($i=0; $i < count($params); $i++){
                if ($params[$i]!=='') {
                    $context->request->add_params(
                        'GET',
                        "param$i",
                        $params[$i]
                    );
                }
            }
        }
    }
?>
