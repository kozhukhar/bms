<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sales".
 *
 * @property int $id
 * @property int|null $batch_id
 * @property string|null $sale_date
 * @property float|null $quantity_sold
 * @property string|null $customer_name
 * @property float|null $sale_price
 *
 * @property Batches $batch
 */
class Sales extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['batch_id', 'sale_date', 'quantity_sold', 'customer_name', 'sale_price'], 'default', 'value' => null],
            [['batch_id'], 'integer'],
            [['sale_date'], 'safe'],
            [['quantity_sold', 'sale_price'], 'number'],
            [['customer_name'], 'string', 'max' => 255],
            [['batch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Batches::class, 'targetAttribute' => ['batch_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch_id' => 'Batch ID',
            'sale_date' => 'Sale Date',
            'quantity_sold' => 'Quantity Sold',
            'customer_name' => 'Customer Name',
            'sale_price' => 'Sale Price',
        ];
    }

    /**
     * Gets query for [[Batch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBatch()
    {
        return $this->hasOne(Batches::class, ['id' => 'batch_id']);
    }

}
