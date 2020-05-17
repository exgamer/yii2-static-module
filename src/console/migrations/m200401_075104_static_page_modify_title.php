<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m200401_075104_post_modify_title_from_h1
 */
class m200401_075104_static_page_modify_title extends Migration
{
    /**
     * @inheritDoc
     */
    public function getTableName()
    {
        return 'static_page_localization';
    }

    /**
     * @inheritDoc
     */
    public function safeUp()
    {
        $sql = "UPDATE {$this->getTableName()} SET title = seo_h1 WHERE seo_h1 IS NOT NULL";
        $this->execute($sql);
        $sql = "UPDATE {$this->getTableName()} SET seo_h1 = NULL";
        $this->execute($sql);
        $this->renameColumn($this->getTableName(), 'title', 'header');
    }
}
