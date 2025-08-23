<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Breweries".
 *
 * @property int $id
 * @property string $name
 * @property string|null $location
 * @property string|null $established_year
 * @property string|null $contact_email
 * @property string|null $contact_phone
 *
 * @property Employees[] $employees
 * @property Products[] $products
 */
class Breweries extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Breweries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location', 'established_year', 'contact_email', 'contact_phone'], 'default', 'value' => null],
            [['name'], 'required'],
            [['established_year'], 'safe'],
            [['name', 'location', 'contact_email'], 'string', 'max' => 255],
            [['contact_phone'], 'string', 'max' => 50],
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
            'location' => 'Location',
            'established_year' => 'Established Year',
            'contact_email' => 'Contact Email',
            'contact_phone' => 'Contact Phone',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::class, ['brewery_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['brewery_id' => 'id']);
    }

}
