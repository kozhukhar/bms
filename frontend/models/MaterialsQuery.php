<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Materials]].
 *
 * @see Materials
 */
class MaterialsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Materials[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Materials|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
