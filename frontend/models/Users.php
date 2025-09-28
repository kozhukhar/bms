<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $username
 * @property string|null $display_name
 * @property string|null $email
 * @property string $created_at
 *
 * @property InventoryMovements[] $inventoryMovements
 */
class Users extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['display_name', 'email'], 'default', 'value' => null],
            [['id', 'username'], 'required'],
            [['created_at'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['username'], 'string', 'max' => 128],
            [['display_name', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
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
            'username' => 'Username',
            'display_name' => 'Display Name',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[InventoryMovements]].
     *
     * @return \yii\db\ActiveQuery|InventoryMovementsQuery
     */
    public function getInventoryMovements()
    {
        return $this->hasMany(InventoryMovements::class, ['created_by' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

}
