<?php

namespace Application;

use Application\Service\CustomFileErrorLoggerService;
use Application\Service\CustomDbErrorLoggerService;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * getServiceConfig
     *
     * Defines the config for Services
     * stored in NAMESPACE/src/NAMESPACE/Service/..
     *
     * @access public
     * @return array
     */
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'CustomFileErrorLoggerService' => function($sm) {
                    $service = new CustomFileErrorLoggerService();
                    return $service;
                },
                'CustomDbErrorLoggerService' => function($sm) {
                    $service = new CustomDbErrorLoggerService();
                    return $service;
                },
            )
        );
    }
}
