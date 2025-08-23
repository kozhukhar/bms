<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Inventory".
 *
 * @property int $id
 * @property int|null $ingredient_id
 * @property float|null $quantity
 * @property string|null $unit
 * @property string|null $last_updated
 *
 * @property Ingredients $ingredient
 */
class Inventory extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredient_id', 'quantity', 'unit'], 'default', 'value' => null],
            [['ingredient_id'], 'integer'],
            [['quantity'], 'number'],
            [['last_updated'], 'safe'],
            [['unit'], 'string', 'max' => 20],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::class, 'targetAttribute' => ['ingredient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ingredient_id' => 'Ingredient ID',
            'quantity' => 'Quantity',
            'unit' => 'Unit',
            'last_updated' => 'Last Updated',
        ];
    }

    /**
     * Gets query for [[Ingredient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredients::class, ['id' => 'ingredient_id']);
    }

}
