<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RecipeVersions]].
 *
 * @see RecipeVersions
 */
class RecipeVersionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RecipeVersions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RecipeVersions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
