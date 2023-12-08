<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\shop\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\shop\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'category_id', 'label_id'], 'integer'],
            [['name', 'description', 'short_description', 'seo_title', 'seo_description'], 'safe'],
            [['price', 'old_price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()->select(['id', 'name', 'slug', 'price', 'status_id', 'category_id', 'label_id', 'brand_id', 'currency']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'status_id' => $this->status_id,
            'category_id' => $this->category_id,
            'label_id' => $this->label_id,
        ]);

        $minPrice = Yii::$app->request->get('minPrice');
        $maxPrice = Yii::$app->request->get('maxPrice');
        $query->andFilterWhere(['>=', 'price', $minPrice])
            ->andFilterWhere(['<=', 'price', $maxPrice]);

        if (isset($params['category'])) {
            $query->andFilterWhere(['category_id' => $params['category']]);
        }

        if (isset($params['status'])) {
            $query->andFilterWhere(['status_id' => $params['status']]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description]);

        return $dataProvider;
    }
}
