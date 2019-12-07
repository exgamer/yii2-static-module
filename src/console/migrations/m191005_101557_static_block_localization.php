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
//            'id' => $this->bigPrimaryKey(),
            'entity_id' => $this->bigInteger()->notNull(),
            'locale' => $this->bigInteger()->notNull(),
            'content' => $this->text()->notNull()
        ]);
        $this->addPK(['entity_id', 'locale'], true);
        $this->addIndex(['entity_id']);
//        $this->addIndex(['entity_id', 'locale'], true);
        $this->addIndex(['locale']);
        $this->addForeign('entity_id', 'static_block','id');
        $this->addForeign('locale', 'locale','id');
    }
}
