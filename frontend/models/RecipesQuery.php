<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Recipes]].
 *
 * @see Recipes
 */
class RecipesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Recipes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Recipes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
