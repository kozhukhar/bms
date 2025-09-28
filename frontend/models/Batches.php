<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batches".
 *
 * @property string $id
 * @property string|null $production_order_id
 * @property string $batch_number
 * @property string $material_id
 * @property string|null $lot_id
 * @property float $quantity
 * @property string $uom_id
 * @property string $status
 * @property string|null $produced_at
 * @property string $created_at
 *
 * @property InventoryMovementLines[] $inventoryMovementLines
 * @property Materials $material
 * @property ProductionOrders $productionOrder
 * @property StockItems[] $stockItems
 * @property Uoms $uom
 */
class Batches extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['production_order_id', 'lot_id', 'produced_at'], 'default', 'value' => null],
            [['quantity'], 'default', 'value' => 0.0000],
            [['status'], 'default', 'value' => 'open'],
            [['id', 'batch_number', 'material_id', 'uom_id'], 'required'],
            [['quantity'], 'number'],
            [['produced_at', 'created_at'], 'safe'],
            [['id', 'production_order_id', 'material_id', 'uom_id'], 'string', 'max' => 36],
            [['batch_number', 'lot_id'], 'string', 'max' => 128],
            [['status'], 'string', 'max' => 32],
            [['id'], 'unique'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::class, 'targetAttribute' => ['material_id' => 'id']],
            [['production_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductionOrders::class, 'targetAttribute' => ['production_order_id' => 'id']],
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
            'production_order_id' => 'Production Order ID',
            'batch_number' => 'Batch Number',
            'material_id' => 'Material ID',
            'lot_id' => 'Lot ID',
            'quantity' => 'Quantity',
            'uom_id' => 'Uom ID',
            'status' => 'Status',
            'produced_at' => 'Produced At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[InventoryMovementLines]].
     *
     * @return \yii\db\ActiveQuery|InventoryMovementLinesQuery
     */
    public function getInventoryMovementLines()
    {
        return $this->hasMany(InventoryMovementLines::class, ['batch_id' => 'id']);
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
     * Gets query for [[ProductionOrder]].
     *
     * @return \yii\db\ActiveQuery|ProductionOrdersQuery
     */
    public function getProductionOrder()
    {
        return $this->hasOne(ProductionOrders::class, ['id' => 'production_order_id']);
    }

    /**
     * Gets query for [[StockItems]].
     *
     * @return \yii\db\ActiveQuery|StockItemsQuery
     */
    public function getStockItems()
    {
        return $this->hasMany(StockItems::class, ['batch_id' => 'id']);
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
     * @return BatchesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchesQuery(get_called_class());
    }

}
