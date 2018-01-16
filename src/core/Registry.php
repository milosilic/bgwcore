<?php
declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: ila
 * Date: 15.9.17.
 * Time: 14.37
 */

namespace Bgw\Core;

use Bgw\Core\DbFactory\Mongo;
use Bgw\Core\DbFactory\RabbitMq;
use Bgw\Core\Mapper\Mysql;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Registry
{
    private static $instance=null;
    private $request = null;
    private $conf = null;
    private $commands = null;
    private $pdo = null;
    private $applicationHelper = null;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function reset()
    {
        self::$instance = null;
    }

    // must be initialized by some smarter component
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        if (is_null($this->request)) {
            throw new \Exception("No Request set");
        }

        return $this->request;
    }

    public function getApplicationHelper(): ApplicationHelper
    {
        if (is_null($this->applicationHelper)) {
            $this->applicationHelper = new ApplicationHelper();
        }

        return $this->applicationHelper;
    }

    public function setConf(Conf $conf)
    {
        $this->conf = $conf;
    }

    public function getConf(): Conf
    {
        if (is_null($this->conf)) {
            $this->conf = new Conf();
        }

        return $this->conf;
    }

    public function setCommands(Conf $commands)
    {
        $this->commands = $commands;
    }

    public function getCommands(): Conf
    {
        return $this->commands;
    }

//    public function getDSN(): string
//    {
//        $conf = $this->getConf();
//        return $conf->get("dsn");
//    }

    public function getUsername(): string
    {
        $conf = $this->getConf();
        return $conf->get("username");
    }

    public function getPassword(): string
    {
        $conf = $this->getConf();
        return $conf->get("password");
    }

    public function getConnection($driver, $connectionString)
    {
        switch ($driver){
            case "mysql": return  $this->getPdo($connectionString);
            case "rabbitmq": return $this->getRabbitConnection($connectionString);
            case "mongo": return $this->getMongoConnection($connectionString);

        }
    }

    // TODO nije dobro, skidaj ovaj Conf, tj. reimplementiraj
    public function getPdo($connectionString): \PDO
    {

        $mysqlConfArray = $this->conf->get('mysql');
        $mysqlConf =  new Conf($mysqlConfArray[$connectionString]);

        $mysqlConnection = new \bgw\core\DbFactory\Mysql($mysqlConf);
        $this->pdo = $mysqlConnection->getConnection();

        return $this->pdo;
    }

    public function getRabbitConnection($connectionString):AMQPStreamConnection
    {
        if( empty($this->conf) ) {
            var_dump( $this);
            throw new \Exception('no rabbitmq db config');
        }

        $rabbitmqConfArray = $this->conf->get('rabbitmq');
        $rabbitmqConf =  new Conf($rabbitmqConfArray[$connectionString]);

        $rabbitDb = new RabbitMq($rabbitmqConf);

       // $rabbitDb = new RabbitMq(new Conf($this->conf->get('broker')));
        return $rabbitDb->getConnection();
    }

    public function getMongoConnection($connectionString)
    {
        if( empty($this->conf) ) {
            throw new \Exception('no mongo db config');
        }

        $mongoConfArray = $this->conf->get('mongo');
        $mongoConf =  new Conf($mongoConfArray[$connectionString]);


        $mongoDb = new Mongo($mongoConf);
        return $mongoDb->getConnection();
    }

    /* listing 13.10 */

    public function getMysqlMapper(): Mapper
    {
        return new Mysql();
    }
/*
    public function getSpaceMapper(): SpaceMapper
    {
        return new SpaceMapper();
    }

    public function getEventMapper(): EventMapper
    {
        return new EventMapper();
    }

    public function getVenueCollection(): VenueCollection
    {
        return new VenueCollection();
    }

    public function getSpaceCollection(): SpaceCollection
    {
        return new SpaceCollection();
    }

    public function getEventCollection(): EventCollection
    {
        return new EventCollection();
    }*/

    /* /listing 13.10 */
}