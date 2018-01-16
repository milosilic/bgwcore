<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 18.9.17.
 * Time: 12.32
 */

namespace Bgw\core\DbFactory;

use Bgw\core\Conf;
use Bgw\core\DbFactory;
use MongoConnectionException;

class Mongo extends DbFactory
{
    public function __construct(Conf $conf)
    {
        parent::__construct($conf);
    }

    public function getConnection()
    {
        try {
            // get mongo db connection
            $db = new \MongoDB\Client(
                "mongodb://{$this->getHost()}:{$this->getPort()}",
                array(
                    'username' => $this->getUsername(),
                    'password' => $this->getPassword()
                ),
                [
                    'typeMap' => [
                        'array' => 'array',
                        'document' => 'array',
                        'root' => 'array',
                    ],
                ]
            );
            // get db
            $dbName = $this->getDbname();
            $dataBase = $db->$dbName;
            return $dataBase;

        } catch (MongoConnectionException $e) {
            //echo '<pre>';
            print_r($e);//die;
        }



        return null;


    }
    
}