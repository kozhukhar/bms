<?php

use yiidbMigration;

class m240508_create_production_orders_and_batches extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%production_orders}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'code' => $this->string(64)->notNull()->unique(),
            'recipe_version_id' => $this->char(36)->notNull(),
            'planned_quantity' => $this->decimal(18,4)->notNull()->defaultValue(0),
            'uom_id' => $this->char(36)->notNull(),
            'status' => $this->string(32)->notNull()->defaultValue('planned'),
            'planned_start' => $this->dateTime()->null(),
            'planned_end' => $this->dateTime()->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-production_orders-recipe_version_id', '{{%production_orders}}', 'recipe_version_id');
        $this->createIndex('idx-production_orders-uom_id', '{{%production_orders}}', 'uom_id');
        $this->addForeignKey('fk-production_orders-recipe_version', '{{%production_orders}}', 'recipe_version_id', '{{%recipe_versions}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk-production_orders-uom', '{{%production_orders}}', 'uom_id', '{{%uoms}}', 'id', 'RESTRICT', 'RESTRICT');

        $this->createTable('{{%batches}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'production_order_id' => $this->char(36)->null(),
            'batch_number' => $this->string(128)->notNull(),
            'material_id' => $this->char(36)->notNull(),
            'lot_id' => $this->string(128)->null(),
            'quantity' => $this->decimal(18,4)->notNull()->defaultValue(0),
            'uom_id' => $this->char(36)->notNull(),
            'status' => $this->string(32)->notNull()->defaultValue('open'),
            'produced_at' => $this->dateTime()->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),        ]);

        $this->createIndex('idx-batches-production_order_id', '{{%batches}}', 'production_order_id');
        $this->createIndex('idx-batches-material_id', '{{%batches}}', 'material_id');
        $this->addForeignKey('fk-batches-production_order', '{{%batches}}', 'production_order_id', '{{%production_orders}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-batches-material', '{{%batches}}', 'material_id', '{{%materials}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk-batches-uom', '{{%batches}}', 'uom_id', '{{%uoms}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-batches-uom', '{{%batches}}');
        $this->dropForeignKey('fk-batches-material', '{{%batches}}');
        $this->dropForeignKey('fk-batches-production_order', '{{%batches}}');
        $this->dropTable('{{%batches}}');

        $this->dropForeignKey('fk-production_orders-uom', '{{%production_orders}}');
        $this->dropForeignKey('fk-production_orders-recipe_version', '{{%production_orders}}');
        $this->dropTable('{{%production_orders}}');
    }
}