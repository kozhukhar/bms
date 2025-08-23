<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Ingredients".
 *
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property string|null $supplier
 * @property float|null $unit_cost
 *
 * @property Inventory[] $inventories
 */
class Ingredients extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'supplier', 'unit_cost'], 'default', 'value' => null],
            [['name'], 'required'],
            [['unit_cost'], 'number'],
            [['name', 'supplier'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'supplier' => 'Supplier',
            'unit_cost' => 'Unit Cost',
        ];
    }

    /**
     * Gets query for [[Inventories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::class, ['ingredient_id' => 'id']);
    }

}
