<?php

use yiidbMigration;

class m240509_create_stock_items extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%stock_items}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'material_id' => $this->char(36)->notNull(),
            'lot_id' => $this->string(128)->null(),
            'batch_id' => $this->char(36)->null(),
            'location_id' => $this->char(36)->null(),
            'quantity' => $this->decimal(18,4)->notNull()->defaultValue(0),
            'uom_id' => $this->char(36)->notNull(),
            'status' => $this->string(32)->notNull()->defaultValue('available'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-stock_items-material_id', '{{%stock_items}}', 'material_id');
        $this->createIndex('idx-stock_items-lot_id', '{{%stock_items}}', 'lot_id');
        $this->createIndex('idx-stock_items-location_id', '{{%stock_items}}', 'location_id');
        $this->createIndex('idx-stock_items_mat_lot_loc', '{{%stock_items}}', ['material_id', 'lot_id', 'location_id', 'uom_id']);

        $this->addForeignKey('fk-stock_items-material', '{{%stock_items}}', 'material_id', '{{%materials}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk-stock_items-batch', '{{%stock_items}}', 'batch_id', '{{%batches}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-stock_items-location', '{{%stock_items}}', 'location_id', '{{%locations}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-stock_items-uom', '{{%stock_items}}', 'uom_id', '{{%uoms}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-stock_items-uom', '{{%stock_items}}');
        $this->dropForeignKey('fk-stock_items-location', '{{%stock_items}}');
        $this->dropForeignKey('fk-stock_items-batch', '{{%stock_items}}');
        $this->dropForeignKey('fk-stock_items-material', '{{%stock_items}}');
        $this->dropTable('{{%stock_items}}');
    }
}