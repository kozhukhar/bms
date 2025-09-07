<?php

use yiidbMigration;

class m240503_create_users extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'username' => $this->string(128)->notNull()->unique(),
            'display_name' => $this->string(255)->null(),
            'email' => $this->string(255)->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}