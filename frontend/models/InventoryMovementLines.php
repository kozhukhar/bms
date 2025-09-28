<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory_movement_lines".
 *
 * @property string $id
 * @property string $inventory_movement_id
 * @property string $material_id
 * @property string|null $lot_id
 * @property string|null $batch_id
 * @property string|null $from_location_id
 * @property string|null $to_location_id
 * @property float $quantity
 * @property string $uom_id
 * @property string $created_at
 *
 * @property Batches $batch
 * @property Locations $fromLocation
 * @property InventoryMovements $inventoryMovement
 * @property Materials $material
 * @property Locations $toLocation
 * @property Uoms $uom
 */
class InventoryMovementLines extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_movement_lines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lot_id', 'batch_id', 'from_location_id', 'to_location_id'], 'default', 'value' => null],
            [['quantity'], 'default', 'value' => 0.0000],
            [['id', 'inventory_movement_id', 'material_id', 'uom_id'], 'required'],
            [['quantity'], 'number'],
            [['created_at'], 'safe'],
            [['id', 'inventory_movement_id', 'material_id', 'batch_id', 'from_location_id', 'to_location_id', 'uom_id'], 'string', 'max' => 36],
            [['lot_id'], 'string', 'max' => 128],
            [['id'], 'unique'],
            [['batch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Batches::class, 'targetAttribute' => ['batch_id' => 'id']],
            [['from_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['from_location_id' => 'id']],
            [['inventory_movement_id'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryMovements::class, 'targetAttribute' => ['inventory_movement_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::class, 'targetAttribute' => ['material_id' => 'id']],
            [['to_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['to_location_id' => 'id']],
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
            'inventory_movement_id' => 'Inventory Movement ID',
            'material_id' => 'Material ID',
            'lot_id' => 'Lot ID',
            'batch_id' => 'Batch ID',
            'from_location_id' => 'From Location ID',
            'to_location_id' => 'To Location ID',
            'quantity' => 'Quantity',
            'uom_id' => 'Uom ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Batch]].
     *
     * @return \yii\db\ActiveQuery|BatchesQuery
     */
    public function getBatch()
    {
        return $this->hasOne(Batches::class, ['id' => 'batch_id']);
    }

    /**
     * Gets query for [[FromLocation]].
     *
     * @return \yii\db\ActiveQuery|LocationsQuery
     */
    public function getFromLocation()
    {
        return $this->hasOne(Locations::class, ['id' => 'from_location_id']);
    }

    /**
     * Gets query for [[InventoryMovement]].
     *
     * @return \yii\db\ActiveQuery|InventoryMovementsQuery
     */
    public function getInventoryMovement()
    {
        return $this->hasOne(InventoryMovements::class, ['id' => 'inventory_movement_id']);
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
     * Gets query for [[ToLocation]].
     *
     * @return \yii\db\ActiveQuery|LocationsQuery
     */
    public function getToLocation()
    {
        return $this->hasOne(Locations::class, ['id' => 'to_location_id']);
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
     * @return InventoryMovementLinesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InventoryMovementLinesQuery(get_called_class());
    }

}
