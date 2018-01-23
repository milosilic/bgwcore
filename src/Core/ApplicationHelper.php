<?php
declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: ila
 * Date: 19.10.17.
 * Time: 16.01
 */

namespace Bgw\Core;


class ApplicationHelper
{


    public static function unpackStream(string $dataString, array $getUnpackMask, array $lengthsOfEachVariable):array
    {
        //$dataString = "abcdef1234567890";
//        $dataString = "abcdef123456/78901122334455667788";
//        var_dump($dataString);
        $keys = array_keys($getUnpackMask);
        $positions = array_values($getUnpackMask);
//die;

        $unpakFunc = array_map(function($sensor, $position, $length) use($dataString) {

            //var_dump($sensor ." " .  $position . " ". $length. " ". substr($dataString, -1*($position+1), $length));
            return array($sensor => substr($dataString, -1*($position+$length), $length));
        }, $keys, $positions, $lengthsOfEachVariable);

        $reducedArray = array_reduce($unpakFunc,function($reducedArray, $element){
                    foreach ($element as $sensorName => $sensorValue){
                        $reducedArray[$sensorName]= $sensorValue;
                    }

                    return $reducedArray;
        }, array());




        return $reducedArray;

    }
}