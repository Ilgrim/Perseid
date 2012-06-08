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
    require_once("context.inc.php");

    class dispatcher{

        private $context;
        private $hooks;

        public function __construct($CONFIG) {
            $this->hooks = Array();
            $this->context = new context($CONFIG);
        }
        public function __destruct() {
            unset( $this->context );
            unset( $this->hooks );
            unset( $this->context );
        }

        public function execute_hooks() {
            foreach($this->hooks as $hook){
                if($hook){
                    $hook->execute( $this->context );
                }
            }
        }

        public function add_hook($name) {
            if ( !array_key_exists( $name, $this->hooks ) )
            {
                try{
                    $dir = $this->context->config
                                                ->get_param('PATHS');

                    $this->hooks[$name] = Utils::helper_class_invoker(
                                                $name,
                                                $dir['hooks']
                    );
                }catch( Exception $ex ){
                    echo ":: Error importing Class file ->".
                                        $ex->getMessage()."\n".$ex."\n";
                }
            }
        }

        public function get_context(){
            return $this->context;
        }

        /****************************************************************************
        *   Expose data from $this->context to the View.
        *   These datas, are all variables needed in current View
        *   and has been processed during Runner hook execution.
        ****************************************************************************/
        public function load_view(){
            $view = $this->context->request->get_view();
            try{
                $view->load( $this->context );
            }catch(Exception $ex){
                echo $ex->getMessage();
            }

            unset($conf);
            unset($view);
        }
    }
?>
