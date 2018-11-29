<?php

/**
 * Logger
 *
 * CustomDbErrorLoggerService
 *
 * A wrapper for logging the error messages to the database when called from the Controllers.
 *
 */

namespace Application\Service;

use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Log\Formatter;
use Zend\Log\Writer;
use Zend\Log\Logger;

class CustomDbErrorLoggerService {

    /**
     * @var type Logger.
     */
    protected $_conn;

    /**
     * Constructor.
     */
    public function __construct() {
        $dbConnection = new DbAdapter([
            'driver'   => 'Pdo',
            'dsn'      => 'mysql:dbname=loggerDemo;host=localhost',
            'username' => 'root',
            'password' => 'password'
        ]);

        $this->setConnection($dbConnection);
    }

    /**
     * setLogger
     * Set the Logger instance.
     *
     * @param type $logger
     * @access public
     */
    public function setConnection($connection = null) {
        $this->_conn = $connection;
    }

    /**
     * getLogger
     * Returns the Logger instance.
     *
     * @access public
     * @return type
     */
    public function getConnection() {
        return $this->_conn;
    }

    /**
     * log
     * Logs the Exception.
     *
     * @param string $date
     * @param string $errorType
     * @param string $message
     * @access public
     */
    public function logDb($date = '', $errorType = 'notice', $message=null) {

        // Map event data to database columns
        $mapping = [
            'timestamp' => $date,
            'priority'  => $errorType,
            'message'   => $message,
        ];

        $writerDb = new Writer\Db($this->getConnection(), 'dbLog', $mapping); // tablename dbLog
        $formatter = new Formatter\Base();
        $formatter->setDateTimeFormat('Y-m-d H:i:s'); // MySQL DATETIME format
        $writerDb->setFormatter($formatter);

        $logger = new Logger();
        $logger->addWriter($writerDb, 1);
    }

}
