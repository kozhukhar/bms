<?php

use yiidbMigration;

class m240507_create_recipe_ingredients extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%recipe_ingredients}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'recipe_version_id' => $this->char(36)->notNull(),
            'material_id' => $this->char(36)->notNull(),
            'quantity' => $this->decimal(18,4)->notNull()->defaultValue(0),
            'uom_id' => $this->char(36)->notNull(),
            'optional' => $this->boolean()->notNull()->defaultValue(false),
            'sequence' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->createIndex('idx-recipe_ingredients-recipe_version_id', '{{%recipe_ingredients}}', 'recipe_version_id');
        $this->createIndex('idx-recipe_ingredients-material_id', '{{%recipe_ingredients}}', 'material_id');

        $this->addForeignKey('fk-recipe_ingredients-recipe_version', '{{%recipe_ingredients}}', 'recipe_version_id', '{{%recipe_versions}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-recipe_ingredients-material', '{{%recipe_ingredients}}', 'material_id', '{{%materials}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk-recipe_ingredients-uom', '{{%recipe_ingredients}}', 'uom_id', '{{%uoms}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-recipe_ingredients-uom', '{{%recipe_ingredients}}');
        $this->dropForeignKey('fk-recipe_ingredients-material', '{{%recipe_ingredients}}');
        $this->dropForeignKey('fk-recipe_ingredients-recipe_version', '{{%recipe_ingredients}}');
        $this->dropTable('{{%recipe_ingredients}}');
    }
}