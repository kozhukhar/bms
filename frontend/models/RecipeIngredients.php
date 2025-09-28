<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recipe_ingredients".
 *
 * @property string $id
 * @property string $recipe_version_id
 * @property string $material_id
 * @property float $quantity
 * @property string $uom_id
 * @property int $optional
 * @property int $sequence
 *
 * @property Materials $material
 * @property RecipeVersions $recipeVersion
 * @property Uoms $uom
 */
class RecipeIngredients extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipe_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity'], 'default', 'value' => 0.0000],
            [['sequence'], 'default', 'value' => 0],
            [['id', 'recipe_version_id', 'material_id', 'uom_id'], 'required'],
            [['quantity'], 'number'],
            [['optional', 'sequence'], 'integer'],
            [['id', 'recipe_version_id', 'material_id', 'uom_id'], 'string', 'max' => 36],
            [['id'], 'unique'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::class, 'targetAttribute' => ['material_id' => 'id']],
            [['recipe_version_id'], 'exist', 'skipOnError' => true, 'targetClass' => RecipeVersions::class, 'targetAttribute' => ['recipe_version_id' => 'id']],
            [['uom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Uoms::class, 'targetAttribute' => ['uom_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recipe_version_id' => 'Recipe Version ID',
            'material_id' => 'Material ID',
            'quantity' => 'Quantity',
            'uom_id' => 'Uom ID',
            'optional' => 'Optional',
            'sequence' => 'Sequence',
        ];
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery|MaterialsQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Materials::class, ['id' => 'material_id']);
    }

    /**
     * Gets query for [[RecipeVersion]].
     *
     * @return \yii\db\ActiveQuery|RecipeVersionsQuery
     */
    public function getRecipeVersion()
    {
        return $this->hasOne(RecipeVersions::class, ['id' => 'recipe_version_id']);
    }

    /**
     * Gets query for [[Uom]].
     *
     * @return \yii\db\ActiveQuery|UomsQuery
     */
    public function getUom()
    {
        return $this->hasOne(Uoms::class, ['id' => 'uom_id']);
    }

    /**
     * {@inheritdoc}
     * @return RecipeIngredientsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecipeIngredientsQuery(get_called_class());
    }

}
