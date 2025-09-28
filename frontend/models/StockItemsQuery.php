<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StockItems]].
 *
 * @see StockItems
 */
class StockItemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StockItems[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StockItems|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
