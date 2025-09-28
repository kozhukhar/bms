<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recipe_versions".
 *
 * @property string $id
 * @property string $recipe_id
 * @property int $version_number
 * @property string $status
 * @property string|null $notes
 * @property string $created_at
 *
 * @property ProductionOrders[] $productionOrders
 * @property Recipes $recipe
 * @property RecipeIngredients[] $recipeIngredients
 */
class RecipeVersions extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipe_versions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notes'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'active'],
            [['id', 'recipe_id', 'version_number'], 'required'],
            [['version_number'], 'integer'],
            [['notes'], 'string'],
            [['created_at'], 'safe'],
            [['id', 'recipe_id'], 'string', 'max' => 36],
            [['status'], 'string', 'max' => 32],
            [['id'], 'unique'],
            [['recipe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recipes::class, 'targetAttribute' => ['recipe_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recipe_id' => 'Recipe ID',
            'version_number' => 'Version Number',
            'status' => 'Status',
            'notes' => 'Notes',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[ProductionOrders]].
     *
     * @return \yii\db\ActiveQuery|ProductionOrdersQuery
     */
    public function getProductionOrders()
    {
        return $this->hasMany(ProductionOrders::class, ['recipe_version_id' => 'id']);
    }

    /**
     * Gets query for [[Recipe]].
     *
     * @return \yii\db\ActiveQuery|RecipesQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipes::class, ['id' => 'recipe_id']);
    }

    /**
     * Gets query for [[RecipeIngredients]].
     *
     * @return \yii\db\ActiveQuery|RecipeIngredientsQuery
     */
    public function getRecipeIngredients()
    {
        return $this->hasMany(RecipeIngredients::class, ['recipe_version_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RecipeVersionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecipeVersionsQuery(get_called_class());
    }

}
