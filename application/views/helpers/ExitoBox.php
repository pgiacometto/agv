<?php

/**
 * Description of ErrorBox
 *
 * @author Pedro Giacometto
 */
class Zend_View_Helper_ExitoBox extends Zend_View_Helper_Abstract
{

    public function exitoBox($msg)
    {
        // reset($msg);
       $html='';
        foreach ($msg as $i => $value) {
            $html.= '<div class="alert alert-block alert-success">
                       <button type="button" class="close" data-dismiss="alert">
                         <i class="icon-remove"></i>
                       </button>
                       <strong>
                        <i class="icon-remove"></i> '
                        .ucwords ($i).
                      ' </strong>'
                        .current($value).
                      '</div>';                   
        };

        return $html;
    }

}

