<?php declare(strict_types=1);


namespace App\Migration;


use Swoft\Db\Schema;
use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class AddUserSwoft
 *
 * @since 2.0
 *
 * @Migration(time=20190828113337,pool="db2.pool")
 */
class AddUserSwoft extends BaseMigration
{
    /**
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function up(): void
    {
        $schema     = Schema::getSchemaBuilder('db2.pool');

        $schema->createIfNotExists('user', function (Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->string('name',50)->default('');
            $blueprint->smallInteger('age')->default(1);
            $blueprint->string('password', 100)->default('');
            $blueprint->string('user_desc',100)->default('');
            $blueprint->smallInteger('add')->default(0);
            $blueprint->smallInteger('hahh')->default(0);
            $blueprint->string('test_json')->default('');
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

        Schema::getSchemaBuilder('db.pool')->dropIfExists('user');

    }
}
