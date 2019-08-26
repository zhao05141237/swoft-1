<?php


namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * Class TestExecTimeController
 * @package App\Http\Controller
 * @Controller()
 */
class TestExecTimeController
{
    /**
     * @RequestMapping(route="test/{number}")
     * @param int $number
     * @return array
     */
    public function factorial(int $number): array
    {
        $factorial = function ($arg) use (&$factorial) {
            if ($arg == 1) {
                return $arg;
            }

            return $arg * $factorial($arg - 1);
        };

        return [$factorial($number)];
    }


    /**
     * @return array
     * @RequestMapping()
     */
    public function sumAndSleep(): array
    {
        $sum = 0;
        for ($i = 1; $i <= 1000; $i++) {
            $sum += $i;
        }

        usleep(1000);
        return [$sum];
    }

}