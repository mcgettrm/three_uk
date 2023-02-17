<?php
namespace Mcget\Three;


/**
 *
 * This is the config class that allows the application to be customised.
 * By modifying the properties, you can change the database connection details and the api key to suit your local environment
 * Class Config
 * @package Mcget\Three
 */
class Config
{
    private string $apiKey = "JR2PWBN16X3XV0M0";
    private string $dbHost = "localhost";
    private string $dbUser = "root";
    private string $dbPass = "";
    private string $dbName = "threetechtest";
    private int $dbPort = 3306;

    public function getAPIKey():string{
        return $this->apiKey;
    }

    public function getDbHost():string{
        return $this->dbHost;
    }

    public function getDbUser():string{
        return $this->dbUser;
    }

    public function getDbPass():string{
        return $this->dbPass;
    }

    public function getDbName():string{
        return $this->dbName;
    }

    public function getDbPort():int{
        return $this->dbPort;
    }
}