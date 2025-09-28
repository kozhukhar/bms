<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_items".
 *
 * @property string $id
 * @property string $material_id
 * @property string|null $lot_id
 * @property string|null $batch_id
 * @property string|null $location_id
 * @property float $quantity
 * @property string $uom_id
 * @property string $status
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Batches $batch
 * @property Locations $location
 * @property Materials $material
 * @property Uoms $uom
 */
class StockItems extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lot_id', 'batch_id', 'location_id'], 'default', 'value' => null],
            [['quantity'], 'default', 'value' => 0.0000],
            [['status'], 'default', 'value' => 'available'],
            [['id', 'material_id', 'uom_id'], 'required'],
            [['quantity'], 'number'],
            [['updated_at', 'created_at'], 'safe'],
            [['id', 'material_id', 'batch_id', 'location_id', 'uom_id'], 'string', 'max' => 36],
            [['lot_id'], 'string', 'max' => 128],
            [['status'], 'string', 'max' => 32],
            [['id'], 'unique'],
            [['batch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Batches::class, 'targetAttribute' => ['batch_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['location_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::class, 'targetAttribute' => ['material_id' => 'id']],
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
            'material_id' => 'Material ID',
            'lot_id' => 'Lot ID',
            'batch_id' => 'Batch ID',
            'location_id' => 'Location ID',
            'quantity' => 'Quantity',
            'uom_id' => 'Uom ID',
            'status' => 'Status',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery|LocationsQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::class, ['id' => 'location_id']);
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
     * @return StockItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StockItemsQuery(get_called_class());
    }

}
