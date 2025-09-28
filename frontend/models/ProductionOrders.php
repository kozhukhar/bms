<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "production_orders".
 *
 * @property string $id
 * @property string $code
 * @property string $recipe_version_id
 * @property float $planned_quantity
 * @property string $uom_id
 * @property string $status
 * @property string|null $planned_start
 * @property string|null $planned_end
 * @property string $created_at
 *
 * @property Batches[] $batches
 * @property RecipeVersions $recipeVersion
 * @property Uoms $uom
 */
class ProductionOrders extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'production_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['planned_start', 'planned_end'], 'default', 'value' => null],
            [['planned_quantity'], 'default', 'value' => 0.0000],
            [['status'], 'default', 'value' => 'planned'],
            [['id', 'code', 'recipe_version_id', 'uom_id'], 'required'],
            [['planned_quantity'], 'number'],
            [['planned_start', 'planned_end', 'created_at'], 'safe'],
            [['id', 'recipe_version_id', 'uom_id'], 'string', 'max' => 36],
            [['code'], 'string', 'max' => 64],
            [['status'], 'string', 'max' => 32],
            [['code'], 'unique'],
            [['id'], 'unique'],
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
            'code' => 'Code',
            'recipe_version_id' => 'Recipe Version ID',
            'planned_quantity' => 'Planned Quantity',
            'uom_id' => 'Uom ID',
            'status' => 'Status',
            'planned_start' => 'Planned Start',
            'planned_end' => 'Planned End',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Batches]].
     *
     * @return \yii\db\ActiveQuery|BatchesQuery
     */
    public function getBatches()
    {
        return $this->hasMany(Batches::class, ['production_order_id' => 'id']);
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
     * @return ProductionOrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductionOrdersQuery(get_called_class());
    }

}
