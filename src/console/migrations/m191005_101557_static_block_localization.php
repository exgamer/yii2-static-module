<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191005_101557_static_block_localization
 */
class m191005_101557_static_block_localization extends Migration
{
    function getTableName()
    {
        return 'static_block_localization';
    }

    public function up()
    {
        $this->addTable([
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'locale' => $this->integer()->notNull(),
            'seo_name' => $this->string(1024)->notNull(),
            'seo_title' => $this->string(175)->notNull(),
            'seo_description' => $this->string(175)->notNull(),
            'seo_keywords' => $this->string(175)->notNull(),
            'title' => $this->string(1024)->notNull(),
            'content' => $this->text()->notNull()
        ]);
        $this->addIndex(['entity_id']);
        $this->addIndex(['entity_id', 'locale'], true);
        $this->addIndex(['locale']);
    }
}
