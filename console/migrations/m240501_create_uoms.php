<?php

use yii\db\Migration;

class m240501_create_uoms extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%uoms}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'code' => $this->string(32)->notNull()->unique(),
            'name' => $this->string(64)->notNull(),
            'description' => $this->text()->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%uoms}}');
    }
}