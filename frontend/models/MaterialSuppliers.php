<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_suppliers".
 *
 * @property string $id
 * @property string $material_id
 * @property string $supplier_id
 * @property string|null $supplier_sku
 * @property int|null $lead_time_days
 * @property string $created_at
 *
 * @property Materials $material
 * @property Suppliers $supplier
 */
class MaterialSuppliers extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material_suppliers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supplier_sku', 'lead_time_days'], 'default', 'value' => null],
            [['id', 'material_id', 'supplier_id'], 'required'],
            [['lead_time_days'], 'integer'],
            [['created_at'], 'safe'],
            [['id', 'material_id', 'supplier_id'], 'string', 'max' => 36],
            [['supplier_sku'], 'string', 'max' => 128],
            [['id'], 'unique'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::class, 'targetAttribute' => ['material_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::class, 'targetAttribute' => ['supplier_id' => 'id']],
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
            'supplier_id' => 'Supplier ID',
            'supplier_sku' => 'Supplier Sku',
            'lead_time_days' => 'Lead Time Days',
            'created_at' => 'Created At',
        ];
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
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery|SuppliersQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Suppliers::class, ['id' => 'supplier_id']);
    }

    /**
     * {@inheritdoc}
     * @return MaterialSuppliersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialSuppliersQuery(get_called_class());
    }

}
