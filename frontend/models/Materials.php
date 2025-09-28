<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "materials".
 *
 * @property string $id
 * @property string $sku
 * @property string $name
 * @property string $material_type
 * @property string $base_uom_id
 * @property int $is_batch_tracked
 * @property string $created_at
 *
 * @property Uoms $baseUom
 * @property Batches[] $batches
 * @property InventoryMovementLines[] $inventoryMovementLines
 * @property MaterialSuppliers[] $materialSuppliers
 * @property RecipeIngredients[] $recipeIngredients
 * @property StockItems[] $stockItems
 */
class Materials extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_type'], 'default', 'value' => 'raw'],
            [['is_batch_tracked'], 'default', 'value' => 1],
            [['id', 'sku', 'name', 'base_uom_id'], 'required'],
            [['is_batch_tracked'], 'integer'],
            [['created_at'], 'safe'],
            [['id', 'base_uom_id'], 'string', 'max' => 36],
            [['sku', 'material_type'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 255],
            [['sku'], 'unique'],
            [['id'], 'unique'],
            [['base_uom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Uoms::class, 'targetAttribute' => ['base_uom_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Sku',
            'name' => 'Name',
            'material_type' => 'Material Type',
            'base_uom_id' => 'Base Uom ID',
            'is_batch_tracked' => 'Is Batch Tracked',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[BaseUom]].
     *
     * @return \yii\db\ActiveQuery|UomsQuery
     */
    public function getBaseUom()
    {
        return $this->hasOne(Uoms::class, ['id' => 'base_uom_id']);
    }

    /**
     * Gets query for [[Batches]].
     *
     * @return \yii\db\ActiveQuery|BatchesQuery
     */
    public function getBatches()
    {
        return $this->hasMany(Batches::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[InventoryMovementLines]].
     *
     * @return \yii\db\ActiveQuery|InventoryMovementLinesQuery
     */
    public function getInventoryMovementLines()
    {
        return $this->hasMany(InventoryMovementLines::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[MaterialSuppliers]].
     *
     * @return \yii\db\ActiveQuery|MaterialSuppliersQuery
     */
    public function getMaterialSuppliers()
    {
        return $this->hasMany(MaterialSuppliers::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[RecipeIngredients]].
     *
     * @return \yii\db\ActiveQuery|RecipeIngredientsQuery
     */
    public function getRecipeIngredients()
    {
        return $this->hasMany(RecipeIngredients::class, ['material_id' => 'id']);
    }

    /**
     * Gets query for [[StockItems]].
     *
     * @return \yii\db\ActiveQuery|StockItemsQuery
     */
    public function getStockItems()
    {
        return $this->hasMany(StockItems::class, ['material_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return MaterialsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialsQuery(get_called_class());
    }

}
