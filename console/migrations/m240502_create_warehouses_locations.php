<?php

use yiidbMigration;

class m240502_create_warehouses_locations extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%warehouses}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'code' => $this->string(64)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'address' => $this->string(512)->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('{{%locations}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'warehouse_id' => $this->char(36)->notNull(),
            'code' => $this->string(64)->notNull(),
            'name' => $this->string(255)->notNull(),
            'type' => $this->string(64)->notNull()->defaultValue('storage'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-locations-warehouse_id', '{{%locations}}', 'warehouse_id');
        $this->addForeignKey('fk-locations-warehouse', '{{%locations}}', 'warehouse_id', '{{%warehouses}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-locations-warehouse', '{{%locations}}');
        $this->dropTable('{{%locations}}');
        $this->dropTable('{{%warehouses}}');
    }
}