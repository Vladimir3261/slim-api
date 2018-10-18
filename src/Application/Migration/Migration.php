<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 5/30/18
 * Time: 12:47 AM
 */
namespace Application\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

/**
 * Class Migration
 * @package Application\Migration
 */
class Migration extends AbstractMigration
{
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;
    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;

    public function init()
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => getenv('db_host'),
            'database' => getenv('db_name'),
            'username' => getenv('db_user'),
            'password' => getenv('db_password'),
            'charset' => getenv('db_encoding'),
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}