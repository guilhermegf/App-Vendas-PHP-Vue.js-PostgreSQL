<?php

class Singleton {
    private static $instance;

    private function __construct() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('pgsql:host=localhost;dbname=apivendas', 'postgres', '123456');
        }
        return self::$instance;
    }
}
