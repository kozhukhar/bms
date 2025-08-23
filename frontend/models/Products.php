<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Products".
 *
 * @property int $id
 * @property int|null $brewery_id
 * @property string $name
 * @property string|null $style
 * @property float|null $alcohol_content
 * @property string|null $description
 * @property float|null $price
 *
 * @property Batches[] $batches
 * @property Breweries $brewery
 */
class Products extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brewery_id', 'style', 'alcohol_content', 'description', 'price'], 'default', 'value' => null],
            [['brewery_id'], 'integer'],
            [['name'], 'required'],
            [['alcohol_content', 'price'], 'number'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['style'], 'string', 'max' => 100],
            [['brewery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Breweries::class, 'targetAttribute' => ['brewery_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brewery_id' => 'Brewery ID',
            'name' => 'Name',
            'style' => 'Style',
            'alcohol_content' => 'Alcohol Content',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Batches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBatches()
    {
        return $this->hasMany(Batches::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Brewery]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrewery()
    {
        return $this->hasOne(Breweries::class, ['id' => 'brewery_id']);
    }

}
