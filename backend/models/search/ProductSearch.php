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
    public function search()
    {
        $request = Yii::$app->request;
        $params = $request->post();
        $paramsGrid = $request->get();

        $query = Product::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if ($params) {
            Yii::$app->session->set('product_search_params', $params);
        }

        $sessionParams = Yii::$app->session->get('product_search_params', []);
        if ($sessionParams) {
            $params = array_merge($params, $sessionParams);
        }
        if ($paramsGrid) {
            $params = array_merge($params, $paramsGrid);
        }

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
            'brand_id' => $this->brand_id,
        ]);

        if (isset($params['minPrice'])) {
            $minPrice = $params['minPrice'];
        } else {
            $minPrice = Yii::$app->request->post('minPrice');
        }
        if (isset($params['maxPrice'])) {
            $maxPrice = $params['maxPrice'];
        } else {
            $maxPrice = Yii::$app->request->post('maxPrice');
        }

        $query->andFilterWhere(['>=', 'price', $minPrice])
            ->andFilterWhere(['<=', 'price', $maxPrice]);

        if (isset($params['category'])) {
            $query->andFilterWhere(['category_id' => $params['category']]);
        }

        if (isset($params['status'])) {
            $query->andFilterWhere(['status_id' => $params['status']]);
        }

        if (isset($params['brand'])) {
            $query->andFilterWhere(['brand_id' => $params['brand']]);
        }

        if (isset($params['date-update'])) {
            if ($params['date-update'] == 22) {
                $query->orderBy(['date_updated' => SORT_DESC]);
            } else {
                $query->orderBy(['date_updated' => SORT_ASC]);
            }
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description]);

        return $dataProvider;
    }
}
