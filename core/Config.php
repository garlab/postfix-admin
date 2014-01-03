<?php

class ConfigException extends Exception {
    public function __construct($message, $code = null, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

class Config {    
    public static function load($configFile) {
        $config = parse_ini_file($configFile, true);
        
        if (!$config) {
            throw new ConfigException("Cannot parse $configFile");
        }
        
        if (empty($config['database'])) {
            throw new ConfigException("Config has no section mysql");
        }
        DB::setConnectionOptions($config['database']);
    }
}