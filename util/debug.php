<?php
/* Basic template for ICSE Intranet project php files */
/**
 * Created by PhpStorm.
 * User: Silverio
 * Date: 18/01/2017
 * Time: 10:10
 */

    function show_alert ($msg, $type){
        echo '<div class="alert alert-'.$type.'">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <strong>'.$type.'!</strong> '.$msg.'
                                     </div>';
    }

    function console_log ($msg){
        echo '<script>console.log('.$msg.')</script>';
    }

    function js_alert ($msg){
        echo '<script>alert('.$msg.')</script>';
    }