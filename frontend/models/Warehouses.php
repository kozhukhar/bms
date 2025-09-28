<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "warehouses".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string|null $address
 * @property string $created_at
 *
 * @property InventoryMovements[] $inventoryMovements
 * @property Locations[] $locations
 */
class Warehouses extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'default', 'value' => null],
            [['id', 'code', 'name'], 'required'],
            [['created_at'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['code'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 512],
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
            'address' => 'Address',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[InventoryMovements]].
     *
     * @return \yii\db\ActiveQuery|InventoryMovementsQuery
     */
    public function getInventoryMovements()
    {
        return $this->hasMany(InventoryMovements::class, ['warehouse_id' => 'id']);
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery|LocationsQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Locations::class, ['warehouse_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return WarehousesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WarehousesQuery(get_called_class());
    }

}
