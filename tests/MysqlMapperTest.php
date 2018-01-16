<?php
declare(strict_types = 1);
set_time_limit(5);
/**
 * Created by PhpStorm.
 * User: ila
 * Date: 24.9.17.
 * Time: 18.31
 */
class MysqlMapperTest extends \PHPUnit\Framework\TestCase
{

    public function testInsert()
    {
        try {

            $rawMapper = new \Bgw\application\RawMapper(\Bgw\core\Registry::instance()->getConnection("mysql", "comm-unit"), 'raw');
            $rawObject = new \Bgw\application\RawDomainObject('headerheader',"rawrawrawraw" , "bodybodydoby");

            $rawMapper->insert($rawObject);
             }catch(Exception $e)
        {
            var_dump($e->getMessage());
        }



        $this->assertEquals(3,3);
    }

    public function testFindAll()
    {
        $rawMapper = new \Bgw\application\RawMapper(\Bgw\core\Registry::instance()->getConnection("mysql", "comm-unit"), 'raw');
        $identity = $rawMapper->getIdentity();
        $identity->field('id')->eq(500);
        $identity->setLimit(1);
        $collection = $rawMapper->findAll($identity);
//        while($collection->valid()) var_dump($collection->next());
        $total = $collection->count();
        $this->assertEquals(1,$total);
    }
}
