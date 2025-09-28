<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suppliers".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string|null $contact
 * @property string $created_at
 *
 * @property MaterialSuppliers[] $materialSuppliers
 */
class Suppliers extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact'], 'default', 'value' => null],
            [['id', 'code', 'name'], 'required'],
            [['created_at'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['code'], 'string', 'max' => 64],
            [['name', 'contact'], 'string', 'max' => 255],
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
            'contact' => 'Contact',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[MaterialSuppliers]].
     *
     * @return \yii\db\ActiveQuery|MaterialSuppliersQuery
     */
    public function getMaterialSuppliers()
    {
        return $this->hasMany(MaterialSuppliers::class, ['supplier_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SuppliersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuppliersQuery(get_called_class());
    }

}
