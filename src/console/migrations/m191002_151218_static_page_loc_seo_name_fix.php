<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191002_151218_static_page_loc_seo_name_fix
 */
class m191002_151218_static_page_loc_seo_name_fix extends Migration
{
    function getTableName()
    {
        return 'static_page_localization';
    }

    public function up()
    {
        $this->removeColumn("url");
        $this->removeColumn("url_md5_hash");
        $this->removeIndex(['spl_url_md5_hash_index']);
        $this->createColumn("seo_name_md5_hash");
        $this->execute("ALTER TABLE static_page_localization
            ADD INDEX spl_seo_name_md5_hash_index
            USING HASH (seo_name_md5_hash);");
    }
}
