<?php

use yiidbMigration;

class m240504_create_suppliers extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%suppliers}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'code' => $this->string(64)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'contact' => $this->string(255)->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%suppliers}}');
    }
}