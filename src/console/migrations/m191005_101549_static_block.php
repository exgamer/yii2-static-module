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
            'id' => $this->bigPrimaryKey(),
            'user_id' => $this->bigInteger()->notNull(),
            'domain_id' => $this->bigInteger(),
            'alias' => $this->string(50),
            'alias_md5_hash' => $this->string(32),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()")),
            'updated_at' => $this->dateTime(),
            'is_deleted' => $this->smallInteger()->defaultValue(0),
        ]);
        $this->addIndex(['alias']);
        if ($this->isMysql()) {
            $this->execute("ALTER TABLE static_block
            ADD INDEX sbl_alias_md5_hash_index
            USING HASH (alias_md5_hash);");
        }
        if ($this->isPostgres()) {
            $this->execute("CREATE INDEX sbl_alias_md5_hash_index 
            ON static_block USING HASH (alias_md5_hash);;");
        }
        $this->addUniqueIndex(['alias_md5_hash', 'domain_id']);
        $this->addIndex(['user_id']);
        $this->addIndex(['domain_id']);
        $this->addIndex(['status']);
        $this->addIndex(['is_deleted']);
        $this->addForeign('user_id', 'user','id');
        $this->addForeign('domain_id', 'domain','id');
    }
}
