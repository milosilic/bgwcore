<?php
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 18.9.17.
 * Time: 09.46
 */

namespace bgw\core\DbFactory;


use Bgw\core\DbFactory;
use Bgw\core\Conf;


class Mysql extends DbFactory
{

    public function __construct(Conf $conf)
    {
        parent::__construct($conf);
    }

    public function getConnection()
    {
        $pdo = new \PDO('mysql:host='. $this->getHost().';dbname='. $this->getDbname(), $this->getUsername(), $this->getPassword());
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute( \PDO::MYSQL_ATTR_LOCAL_INFILE, TRUE);
        $pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, TRUE);
        return  $pdo;

    }
}