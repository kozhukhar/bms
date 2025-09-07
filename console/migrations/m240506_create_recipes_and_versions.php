<?php

use yiidbMigration;

class m240506_create_recipes_and_versions extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%recipes}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'code' => $this->string(64)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'status' => $this->string(32)->notNull()->defaultValue('draft'),
            'notes' => $this->text()->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('{{%recipe_versions}}', [
            'id' => $this->char(36)->notNull()->append('PRIMARY KEY'),
            'recipe_id' => $this->char(36)->notNull(),
            'version_number' => $this->integer()->notNull(),
            'status' => $this->string(32)->notNull()->defaultValue('active'),
            'notes' => $this->text()->null(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx-recipe_versions-recipe_id', '{{%recipe_versions}}', 'recipe_id');
        $this->addForeignKey('fk-recipe_versions-recipe', '{{%recipe_versions}}', 'recipe_id', '{{%recipes}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {        $this->dropForeignKey('fk-recipe_versions-recipe', '{{%recipe_versions}}');
        $this->dropTable('{{%recipe_versions}}');
        $this->dropTable('{{%recipes}}');
    }
}