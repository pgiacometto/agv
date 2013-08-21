<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoload()
    {
        $modules = array(
            'Default',
            'Ventas'
        );

        foreach ($modules as $module) {
            $autoloader = new Zend_Application_Module_Autoloader(array(
                'namespace' => ucfirst($module),
                'basePath' => APPLICATION_PATH . '/modules/' . strtolower($module)
            ));
        }

        return $autoloader;
    }

    protected function _initLocale()
    {
        $locale = new Zend_Locale();
        $locale->setLocale('es_ES');
        Zend_Registry::set('Zend_Locale', $locale); // la registramos para su futuro uso en el resto de la aplicación } 
    }
    
}
    