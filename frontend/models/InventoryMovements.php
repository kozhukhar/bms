<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory_movements".
 *
 * @property string $id
 * @property string $code
 * @property string $movement_type
 * @property string|null $reference
 * @property string|null $warehouse_id
 * @property string|null $created_by
 * @property string $created_at
 *
 * @property Users $createdBy
 * @property InventoryMovementLines[] $inventoryMovementLines
 * @property Warehouses $warehouse
 */
class InventoryMovements extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_movements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reference', 'warehouse_id', 'created_by'], 'default', 'value' => null],
            [['id', 'code', 'movement_type'], 'required'],
            [['created_at'], 'safe'],
            [['id', 'warehouse_id', 'created_by'], 'string', 'max' => 36],
            [['code', 'movement_type'], 'string', 'max' => 64],
            [['reference'], 'string', 'max' => 128],
            [['code'], 'unique'],
            [['id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['created_by' => 'id']],
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
            'code' => 'Code',
            'movement_type' => 'Movement Type',
            'reference' => 'Reference',
            'warehouse_id' => 'Warehouse ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[InventoryMovementLines]].
     *
     * @return \yii\db\ActiveQuery|InventoryMovementLinesQuery
     */
    public function getInventoryMovementLines()
    {
        return $this->hasMany(InventoryMovementLines::class, ['inventory_movement_id' => 'id']);
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
     * @return InventoryMovementsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InventoryMovementsQuery(get_called_class());
    }

}
