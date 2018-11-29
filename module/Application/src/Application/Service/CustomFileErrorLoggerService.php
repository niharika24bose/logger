<?php

/**
 * Logger
 * 
 * CustomFileErrorLoggerService
 * 
 * A wrapper for logging the error messages to the file when called from the Controllers.
 *
 */

namespace Application\Service;

use Zend\Log\Logger,
    Zend\Log\Writer\Stream as LogWriterStream;

class CustomFileErrorLoggerService {

    /**
     * @var type Logger.
     */
    protected $_logger;

    /**
     * Constructor.
     */
    public function __construct() {
        $filename = 'log_' . date('Y-m-d') . '.log';
        $logger = new Logger();
        $writer = new LogWriterStream('./data/logs/' . $filename);
        $logger->addWriter($writer);

        $this->setLogger($logger);
        if(!is_writable(PUBLIC_FOLDER_PATH . '/../data/logs/' . $filename)) {
            $this->changePermission(PUBLIC_FOLDER_PATH . '/../data/logs/' . $filename);
        }
    }
    
    /**
     * setLogger
     * Set the Logger instance.
     * 
     * @param type $logger
     * @access public
     */
    public function setLogger($logger = null) {
        $this->_logger = $logger;
    }
    
    /**
     * getLogger
     * Returns the Logger instance.
     *
     * @access public
     * @return type
     */
    public function getLogger() {
        return $this->_logger;
    }
    
    /**
     * log
     * Logs the Exception.
     * 
     * @param string $code
     * @param \Exception $e
     * @access public
     */
    public function log($code = '', \Exception $e) {
        $code = (string) $code;
        
        $log = '';
        $log = "\nException:\n";
        $log .= "Code: " . 'C_'.$code . "\n";
        $log .= "File: " . $e->getFile() . "\n";
        $log .= "Message " . $e->getMessage() . "\n";
        $log .= "Trace: " . $e->getTraceAsString();
        $log .= "\n";
        
        $this->getLogger()->err($log);
    }
    
    /**
     * simpleLog
     * Logs the Simple Text.
     * 
     * @param string $code
     * @param string $text
     * @access public
     */
    public function simpleLog($code = '', $text = '') {
        $code = (string) $code;
        $text = (string) $text;
        
        $log = '';
        $log = "\nSimple Log:\n";
        $log .= "Code: " . 'C_'.$code . "\n";
        $log .= "Message: " . $text . "\n";
        $log .= "\n";
        
        $this->getLogger()->err($log);
    }

    /**
     * changePermission
     * Changes the File Permission.
     *
     * @param type $filePath
     * @param int $permissions
     * @return boolean
     */
    function changePermission($filePath, $permissions = 0777) {
        if(file_exists($filePath)) {
            $oldMask = umask(0);
            if(@chmod($filePath, $permissions)) {
                umask($oldMask);
                return true;
            } else {
                return false;
            }
        }
    }

}
