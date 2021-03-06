<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MEmp;

/**
 * MEmpSearch represents the model behind the search form about `backend\models\MEmp`.
 */
class MEmpSearch extends MEmp
{
    public $fullname;
    public $username;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['title', 'name', 'surname','fullname','username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = MEmp::find()->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['fullname']=[
          'asc'=>['name'=>SORT_ASC,'surname'=>SORT_DESC],
          'desc'=>['name'=>SORT_DESC,'surname'=>SORT_DESC],
        ];
        $dataProvider->sort->attributes['username']=[
          'asc'=>['m_user.username'=>SORT_ASC],
          'desc'=>['m_user.username'=>SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere('name like "%'.$this->fullname.'%" or surname like "%'.$this->fullname.'%" ');

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'm_user.username' => $this->username,
        ]);


        // $query->andFilterWhere(['like', 'title', $this->title])
        //     ->andFilterWhere(['like', 'name', $this->name])
        //     ->andFilterWhere(['like', 'surname', $this->surname]);

        return $dataProvider;
    }
}
