<?php
declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: ila
 * Date: 20.9.17.
 * Time: 18.22
 */

namespace Bgw\Core\DbFactory;


use Bgw\Core\Conf;
use Bgw\Core\DbFactory;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMq extends DbFactory
{
    public function __construct(Conf $conf)
    {
        parent::__construct($conf);
    }


    public function getConnection():AMQPStreamConnection
    {
        return new AMQPStreamConnection($this->getHost(), $this->getPort(), $this->getUsername(), $this->getPassword());
    }
}