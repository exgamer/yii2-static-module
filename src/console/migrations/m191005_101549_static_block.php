<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191005_101549_static_block
 */
class m191005_101549_static_block extends Migration
{
    function getTableName()
    {
        return 'static_block';
    }

    public function up()
    {
        $this->addTable([
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()")),
            'updated_at' => $this->dateTime()->append('ON UPDATE NOW()'),
        ]);
        $this->addIndex(['user_id']);
        $this->addIndex(['status']);
    }
}
