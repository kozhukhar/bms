<?php

use yiidbMigration;

class m240510_create_inventory_movements_and_lines extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%inventory_movements}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'code' => $this->string(64)->notNull()->unique(),
            'movement_type' => $this->string(64)->notNull(),
            'reference' => $this->string(128)->null(),
            'warehouse_id' => $this->char(36)->null(),
            'created_by' => $this->char(36)->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-inv_movements-warehouse_id', '{{%inventory_movements}}', 'warehouse_id');
        $this->addForeignKey('fk-inv_movements-warehouse', '{{%inventory_movements}}', 'warehouse_id', '{{%warehouses}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-inv_movements-created_by', '{{%inventory_movements}}', 'created_by', '{{%users}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createTable('{{%inventory_movement_lines}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'inventory_movement_id' => $this->char(36)->notNull(),
            'material_id' => $this->char(36)->notNull(),
            'lot_id' => $this->string(128)->null(),
            'batch_id' => $this->char(36)->null(),
            'from_location_id' => $this->char(36)->null(),
            'to_location_id' => $this->char(36)->null(),
            'quantity' => $this->decimal(18,4)->notNull()->defaultValue(0),
            'uom_id' => $this->char(36)->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-inv_lines-inv_movement_id', '{{%inventory_movement_lines}}', 'inventory_movement_id');
        $this->createIndex('idx-inv_lines-material_id', '{{%inventory_movement_lines}}', 'material_id');

        $this->addForeignKey('fk-inv_lines-inv_movement', '{{%inventory_movement_lines}}', 'inventory_movement_id', '{{%inventory_movements}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-inv_lines-material', '{{%inventory_movement_lines}}', 'material_id', '{{%materials}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk-inv_lines-from_location', '{{%inventory_movement_lines}}', 'from_location_id', '{{%locations}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-inv_lines-to_location', '{{%inventory_movement_lines}}', 'to_location_id', '{{%locations}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-inv_lines-batch', '{{%inventory_movement_lines}}', 'batch_id', '{{%batches}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-inv_lines-uom', '{{%inventory_movement_lines}}', 'uom_id', '{{%uoms}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-inv_lines-uom', '{{%inventory_movement_lines}}');
        $this->dropForeignKey('fk-inv_lines-batch', '{{%inventory_movement_lines}}');
        $this->dropForeignKey('fk-inv_lines-to_location', '{{%inventory_movement_lines}}');
        $this->dropForeignKey('fk-inv_lines-from_location', '{{%inventory_movement_lines}}');
        $this->dropForeignKey('fk-inv_lines-material', '{{%inventory_movement_lines}}');
        $this->dropForeignKey('fk-inv_lines-inv_movement', '{{%inventory_movement_lines}}');
        $this->dropTable('{{%inventory_movement_lines}}');

        $this->dropForeignKey('fk-inv_movements-created_by', '{{%inventory_movements}}');
        $this->dropForeignKey('fk-inv_movements-warehouse', '{{%inventory_movements}}');
        $this->dropTable('{{%inventory_movements}}');
    }
}