<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Batches]].
 *
 * @see Batches
 */
class BatchesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Batches[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Batches|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
