<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recipes".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $status
 * @property string|null $notes
 * @property string $created_at
 * @property string $updated_at
 *
 * @property RecipeVersions[] $recipeVersions
 */
class Recipes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notes'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'draft'],
            [['id', 'code', 'name'], 'required'],
            [['notes'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['code'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 32],
            [['code'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'status' => 'Status',
            'notes' => 'Notes',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[RecipeVersions]].
     *
     * @return \yii\db\ActiveQuery|RecipeVersionsQuery
     */
    public function getRecipeVersions()
    {
        return $this->hasMany(RecipeVersions::class, ['recipe_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RecipesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecipesQuery(get_called_class());
    }

}
