<?php

class DbException extends Exception {
    public function __construct($message, $query = null, $errorInfo = null, Exception $previous = null) {
        $code = null;
        $message = "[DB] $message";

        if ($query) {
            $message .= "; query=$query";
        }
        
        if ($errorInfo) {
            list($sqlState, $code, $errorMessage) = $errorInfo;
            $message .= "; error=$errorMessage";
        }
        parent::__construct($message, $code, $previous);
    }
}

abstract class DB {
    private static $_options = NULL;
    private static $_instance = NULL;

    public static function getInstance() {
        if (empty(self::$_instance)) {
            self::connect();
        }
        return self::$_instance;
    }
    
    public static function setConnectionOptions($options) {
        self::$_options = $options;
    }

    private static function connect() {
        if (empty(self::$_options)) {
            throw new DbException('No connection options specified');
        }

        extract(self::$_options);

        $url = "$driver:host=$host;port=$port;dbname=$dbname";
        $options = array();
        
        if (isset($charset)) {
            $options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES $charset";
        }

        self::$_instance = new PDO($url, $user, $pass, $options);
    }

    private static function type($value) {
        $type = gettype($value);
        switch ($type) {
            case 'boolean':
                return PDO::PARAM_BOOL;
            case 'integer':
                return PDO::PARAM_INT;
            case 'double':
            case 'string':
                return PDO::PARAM_STR;
            case 'NULL':
                return PDO::PARAM_NULL;
            default:
            case 'array':
            case 'object':
            case 'resource':
            case 'unknown type':
                throw new DbException("Unsupported type '$type'");
        }
    }

    private static function execute($query, $parameters) {
        $dbh = self::getInstance();
        
        if (!$stmt = $dbh->prepare($query)) {
            throw new DbException('prepare failed', $stmt->queryString, $dbh->errorInfo());
        }
        foreach ($parameters as $parameter => &$variable) {
            $type = self::type($variable);
            if (!$stmt->bindParam(":$parameter", $variable, $type)) {
                throw new DbException("Unable to bind '$parameter' => '$variable'", $stmt->queryString);
            }
        }
        if (!$stmt->execute()) {
            throw new DbException('execute failed', $stmt->queryString, $stmt->errorInfo());
        }
        
        return $stmt;
    }

    public static function getAll($query, $parameters) {
        $stmt = self::execute($query, $parameters);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get($query, $parameters) {
        $stmt = self::execute($query, $parameters);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $data;
    }

    public static function insert($query, $parameters) {
        $stmt = self::execute($query, $parameters);
        return self::getInstance()->lastInsertId();
    }
    
    // For update or delete queries
    public static function update($query, $parameters) {
        $stmt = self::execute($query, $parameters);
        return $stmt->rowCount();
    }
}
