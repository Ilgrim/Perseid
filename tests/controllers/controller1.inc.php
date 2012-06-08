<?php
    /*
    *  Copyright (c) <2011-2012>, <Jose Alvaro Dominguez devlon_delander@gmx.es>
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
    // include_once(dirname(__FILE__).'/../../lib/core/controller.inc.php');

    class controller1 extends controller {
        public function __contruct(){
            parent::__contruct();
        }
        public function __destruct(){
            parent::__destruct();
        }
        public function execute(&$context){
            // ADD a var to the context that the view will render.
            $context->add_param('TEST REQUEST', 'Data added from Controller1.');
        }
    }
?>