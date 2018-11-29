<?php

/**
 * Logger
 * 
 * CustomErrorLoggerFactory
 * 
 * A factory for initialising logging mechanism
 * 1. createService
 *
 */

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Service\CustomFileErrorLoggerService;
use Application\Service\CustomDbErrorLoggerService;


class CustomErrorLoggerFactory implements FactoryInterface {
    
    /**
     * createService
     * 
     * Creates the service for Redis Caching with Doctrine.
     * 
     * @access public
     * @param ServiceLocatorInterface $serviceLocator
     * @return ZendStorageCache
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        if($config)
            $loggerService = new CustomFileErrorLoggerService();
        else
            $loggerService = new CustomDbErrorLoggerService();

        return $loggerService;
    }
    
}