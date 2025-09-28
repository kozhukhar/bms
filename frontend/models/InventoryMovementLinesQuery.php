<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InventoryMovementLines]].
 *
 * @see InventoryMovementLines
 */
class InventoryMovementLinesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InventoryMovementLines[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InventoryMovementLines|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
