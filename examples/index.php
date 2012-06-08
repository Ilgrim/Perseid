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

    /****************************************************************************
    *   Import required Class files and other stuff
    ****************************************************************************/

    require_once('settings.php');
    require_once($CONFIG['PATHS']['lib']."/core/dispatcher.inc.php");

    /****************************************************************************
    *  Create a dispatcher object, and assign it $CONFIG from settings.inc.php
    ****************************************************************************/

    $dispatcher = new dispatcher($CONFIG);

    /****************************************************************************

    *   Middleware added for processing $context

    *   Hooks is the Perseid way of do things. Throught different hooks,
    *   you manipulate the entire context, configuring environment, adding
    *   vars for template use, operating with request metadata, etc....
    *
    *   Core Hooks:
    *
    *   - Sanitizer: Gets $_GET and $_POST params, apply trim for each of them,
    *                and convert chars to htmlentities for protect of injections,
    *                returning a new asociative array with
    *                clean values.
    *
    *   - Beautifier: Implements native SEO friendly URL maps.
    *                Process requests like -> http://site/things/otherstuff/
    *                and extract all parameters
    *
    *    - Runner: Get controller name of mapped url, import php file, return a
    *              controller object and run it filling $context->params with
    *              variables needed by the View(template).

    *   WARNING: Order of addition is important.

    ****************************************************************************/

    $hooks = Array( 'sessioner', 'sanitizer', 'beautifier', 'auth', 'runner');
    foreach( $hooks as $hook )
        $dispatcher->add_hook($hook);

    // Execute added hooks
    $dispatcher->execute_hooks();

    /****************************************************************************
    *   Load VIEW and expose DATA for VIEW's use.
    *
    *   As $data is visible by template content, the template uses $data[$varname]
    *   for get the values.
    ****************************************************************************/

    try{

        $dispatcher->load_view();

    }catch(Exception $ex){
        echo "$ex\n";
    }
    # Free memory
    unset($dispatcher);
?>
