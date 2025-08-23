<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Batches".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $batch_number
 * @property string|null $brew_date
 * @property float|null $quantity_produced
 * @property string|null $status
 *
 * @property Products $product
 * @property Sales[] $sales
 */
class Batches extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Batches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'batch_number', 'brew_date', 'quantity_produced', 'status'], 'default', 'value' => null],
            [['product_id'], 'integer'],
            [['brew_date'], 'safe'],
            [['quantity_produced'], 'number'],
            [['batch_number', 'status'], 'string', 'max' => 50],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'batch_number' => 'Batch Number',
            'brew_date' => 'Brew Date',
            'quantity_produced' => 'Quantity Produced',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['batch_id' => 'id']);
    }

}
