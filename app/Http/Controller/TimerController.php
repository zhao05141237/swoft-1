<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Model\Entity\Users;
use Exception;
use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Log\Helper\CLog;
use Swoft\Redis\Redis;
use Swoft\Stdlib\Helper\JsonHelper;
use Swoft\Timer;

/**
 * Class TimerController
 *
 * @since 2.0
 *
 * @Controller(prefix="timer")
 */
class TimerController
{
    /**
     * @RequestMapping()
     *
     * @return array
     * @throws Exception
     */
    public function after(): array
    {
        $paramOne = 'aa';
        $paramTwo = 'bb';
        Timer::after(3 * 1000, function (int $timerId, $paramOne, $paramTwo) {
            CLog::info('time_id' . $timerId);
            CLog::info('param' . $paramOne);
            CLog::info($paramTwo);
            $this->addUser($timerId);
        }, $paramOne, $paramTwo);

        return ['after'];
    }

    /**
     * @param $timerId
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    private function addUser($timerId)
    {
        $rand = mt_rand(1111111, 9999999);
        $name = 'qi.zhao' . $rand;
        $email = $name . '@163.com';
        $password = password_hash($name, PASSWORD_DEFAULT);

        $user = new Users();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->save();
        $id = $user->getId();

        Redis::set("$id", $user->toArray());
        CLog::info("用户ID=" . $id . " timerId=" . $timerId);
        sgo(function () use ($id) {
            $user = Users::find($id)->toArray();
            CLog::info(JsonHelper::encode($user));
            Redis::del("$id");
        });
    }

    /**
     * @RequestMapping()
     *
     * @return array
     * @throws Exception
     */
    public function tick(): array
    {
        Timer::tick(3 * 1000, function (int $timerId) {
            $this->addUser($timerId);
        });

        return ['tick'];
    }
}