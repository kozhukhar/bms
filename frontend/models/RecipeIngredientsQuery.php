<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RecipeIngredients]].
 *
 * @see RecipeIngredients
 */
class RecipeIngredientsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RecipeIngredients[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RecipeIngredients|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
