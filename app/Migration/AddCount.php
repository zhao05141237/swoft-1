<?php declare(strict_types=1);


namespace App\Migration;


use Swoft\Db\Schema;
use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class AddCount
 *
 * @since 2.0
 *
 * @Migration(time=20190828114853)
 */
class AddCount extends BaseMigration
{
    /**
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function up(): void
    {
        Schema::createIfNotExists('count', function (Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->integer('user_id')->default(0);
            $blueprint->integer('create_time')->default(0);
            $blueprint->string('attributes',50)->default('');
            $blueprint->string('update_time',100)->default('');
        });
    }

    /**
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function down(): void
    {
        Schema::dropIfExists('user');

        Schema::getSchemaBuilder('db.pool')->dropIfExists('count');

    }
}
