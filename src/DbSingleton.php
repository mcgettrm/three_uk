<?php


namespace Mcget\Three;


use PDO;
use PDOException;

/**
 * Class DbSingleton
 * @package Mcget\Three
 */
class DbSingleton
{
    /**
     * @var null
     */
    protected static $instance = null;

    /**
     * @param string $host
     * @param int $port
     * @param string $user
     * @param string $pass
     * @param string $dbName
     * @return PDO
     */
    public static function getInstance(
        string $host,
        int $port,
        string $user,
        string $pass,
        string $dbName
    ):PDO {

        if(is_null(self::$instance)) {
            try {
                self::$instance = new PDO("mysql:host=".$host.';port='.$port.';dbname='.$dbName, $user, $pass);
            } catch(PDOException $error) {

                //Todo:: this should bubble up and log rather than echo
                echo $error->getMessage();
            }
        }

        return self::$instance;
    }
}