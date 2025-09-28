<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InventoryMovements]].
 *
 * @see InventoryMovements
 */
class InventoryMovementsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InventoryMovements[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InventoryMovements|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
