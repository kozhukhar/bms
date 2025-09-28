<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "uoms".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property string $created_at
 *
 * @property Batches[] $batches
 * @property InventoryMovementLines[] $inventoryMovementLines
 * @property Materials[] $materials
 * @property ProductionOrders[] $productionOrders
 * @property RecipeIngredients[] $recipeIngredients
 * @property StockItems[] $stockItems
 */
class Uoms extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uoms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['id', 'code', 'name'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['code'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 64],
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
            'description' => 'Description',
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
        return $this->hasMany(Batches::class, ['uom_id' => 'id']);
    }

    /**
     * Gets query for [[InventoryMovementLines]].
     *
     * @return \yii\db\ActiveQuery|InventoryMovementLinesQuery
     */
    public function getInventoryMovementLines()
    {
        return $this->hasMany(InventoryMovementLines::class, ['uom_id' => 'id']);
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery|MaterialsQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Materials::class, ['base_uom_id' => 'id']);
    }

    /**
     * Gets query for [[ProductionOrders]].
     *
     * @return \yii\db\ActiveQuery|ProductionOrdersQuery
     */
    public function getProductionOrders()
    {
        return $this->hasMany(ProductionOrders::class, ['uom_id' => 'id']);
    }

    /**
     * Gets query for [[RecipeIngredients]].
     *
     * @return \yii\db\ActiveQuery|RecipeIngredientsQuery
     */
    public function getRecipeIngredients()
    {
        return $this->hasMany(RecipeIngredients::class, ['uom_id' => 'id']);
    }

    /**
     * Gets query for [[StockItems]].
     *
     * @return \yii\db\ActiveQuery|StockItemsQuery
     */
    public function getStockItems()
    {
        return $this->hasMany(StockItems::class, ['uom_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UomsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UomsQuery(get_called_class());
    }

}
