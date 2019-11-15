<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191002_151207_static_table
 */
class m191002_151207_static_table extends Migration
{
    function getTableName()
    {
        return 'static_page';
    }

    public function up()
    {
        $this->addTable([
            'id' => $this->bigPrimaryKey(),
            'user_id' => $this->bigInteger()->notNull(),
            'domain_id' => $this->bigInteger(),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()")),
            'updated_at' => $this->dateTime()->append('ON UPDATE NOW()'),
            'is_deleted' => $this->smallInteger()->defaultValue(0),
        ]);
        $this->addIndex(['user_id']);
        $this->addIndex(['domain_id']);
        $this->addIndex(['status']);
        $this->addIndex(['is_deleted']);
    }
}
