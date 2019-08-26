<?php


namespace App\Aspect;

use Swoft\Aop\Annotation\Mapping\After;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\Before;
use Swoft\Aop\Annotation\Mapping\PointBean;
use Swoft\Aop\Point\JoinPoint;
use Swoft\Log\Helper\CLog;

/**
 * Class CalcExecTimeAspect
 * @package App\Aspect
 * @Aspect(order=1)
 *
 * @PointBean(
 *     include={"App\Http\Controller\TestExecTimeController"},
 *     include={"App\Http\Controller\CoController"},
 *     )
 */
class CalcExecTimeAspect
{
    protected $start;

    /**
     * @Before()
     */
    public function before()
    {
        $this->start = microtime(true);
    }

    /**
     * @After()
     * @param JoinPoint $joinPoint
     */
    public function after(JoinPoint $joinPoint)
    {
        $method = $joinPoint->getMethod();
        $after = microtime(true);
        $runtime = ($after - $this->start) * 1000;
        CLog::info("{$method} 方法，本次执行时间为：{$runtime}ms\n");
    }

}