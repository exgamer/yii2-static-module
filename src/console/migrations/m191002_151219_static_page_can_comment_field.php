<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191002_151219_static_page_can_comment_field
 */
class m191002_151219_static_page_can_comment_field extends Migration
{
    function getTableName()
    {
        return 'static_page_localization';
    }

    public function up()
    {
        $this->createColumn("can_comment", $this->smallInteger());
    }
}
