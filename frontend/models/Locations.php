<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property string $id
 * @property string $warehouse_id
 * @property string $code
 * @property string $name
 * @property string $type
 * @property string $created_at
 *
 * @property InventoryMovementLines[] $inventoryMovementLines
 * @property InventoryMovementLines[] $inventoryMovementLines0
 * @property StockItems[] $stockItems
 * @property Warehouses $warehouse
 */
class Locations extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'default', 'value' => 'storage'],
            [['id', 'warehouse_id', 'code', 'name'], 'required'],
            [['created_at'], 'safe'],
            [['id', 'warehouse_id'], 'string', 'max' => 36],
            [['code', 'type'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouses::class, 'targetAttribute' => ['warehouse_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warehouse_id' => 'Warehouse ID',
            'code' => 'Code',
            'name' => 'Name',
            'type' => 'Type',
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
        return $this->hasMany(InventoryMovementLines::class, ['from_location_id' => 'id']);
    }

    /**
     * Gets query for [[InventoryMovementLines0]].
     *
     * @return \yii\db\ActiveQuery|InventoryMovementLinesQuery
     */
    public function getInventoryMovementLines0()
    {
        return $this->hasMany(InventoryMovementLines::class, ['to_location_id' => 'id']);
    }

    /**
     * Gets query for [[StockItems]].
     *
     * @return \yii\db\ActiveQuery|StockItemsQuery
     */
    public function getStockItems()
    {
        return $this->hasMany(StockItems::class, ['location_id' => 'id']);
    }

    /**
     * Gets query for [[Warehouse]].
     *
     * @return \yii\db\ActiveQuery|WarehousesQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouses::class, ['id' => 'warehouse_id']);
    }

    /**
     * {@inheritdoc}
     * @return LocationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocationsQuery(get_called_class());
    }

}
