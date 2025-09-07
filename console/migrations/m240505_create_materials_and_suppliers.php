<?php

use yiidbMigration;

class m240505_create_materials_and_suppliers extends Migration
{
    public function safeUp()
    {
        // materials
        $this->createTable('{{%materials}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'sku' => $this->string(64)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'material_type' => $this->string(64)->notNull()->defaultValue('raw'),
            'base_uom_id' => $this->char(36)->notNull(),
            'is_batch_tracked' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-materials-base_uom_id', '{{%materials}}', 'base_uom_id');
        $this->addForeignKey('fk-materials-uom', '{{%materials}}', 'base_uom_id', '{{%uoms}}', 'id', 'RESTRICT', 'RESTRICT');

        // material_suppliers (M:N)
        $this->createTable('{{%material_suppliers}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'material_id' => $this->char(36)->notNull(),
            'supplier_id' => $this->char(36)->notNull(),
            'supplier_sku' => $this->string(128)->null(),
            'lead_time_days' => $this->integer()->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-material_suppliers-material_id', '{{%material_suppliers}}', 'material_id');
        $this->createIndex('idx-material_suppliers-supplier_id', '{{%material_suppliers}}', 'supplier_id');
        $this->addForeignKey('fk-material_suppliers-material', '{{%material_suppliers}}', 'material_id', '{{%materials}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-material_suppliers-supplier', '{{%material_suppliers}}', 'supplier_id', '{{%suppliers}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-material_suppliers-supplier', '{{%material_suppliers}}');
        $this->dropForeignKey('fk-material_suppliers-material', '{{%material_suppliers}}');
        $this->dropTable('{{%material_suppliers}}');

        $this->dropForeignKey('fk-materials-uom', '{{%materials}}');
        $this->dropTable('{{%materials}}');
    }
}