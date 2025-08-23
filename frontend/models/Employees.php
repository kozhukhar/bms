<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Employees".
 *
 * @property int $id
 * @property int|null $brewery_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $role
 * @property string|null $email
 * @property string|null $phone
 *
 * @property Breweries $brewery
 */
class Employees extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brewery_id', 'first_name', 'last_name', 'role', 'email', 'phone'], 'default', 'value' => null],
            [['brewery_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['role', 'phone'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 255],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'role' => 'Role',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
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
