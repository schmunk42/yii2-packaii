<?php

namespace schmunk42\packaii\models\search;

use yii\data\ArrayDataProvider;

/**
 * Result is a model class used to display/filter Packagist API search results (when  using the method `all` from
 * \dosamigos\packagist\Packagist API component).
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package schmunk42\packaii\models\search
 */
class Result extends Base
{
	/**
	 * @var string the url
	 */
	public $url;
	/**
	 * @var int the total downloads
	 */
	public $downloads;
	/**
	 * @var int the total favers
	 */
	public $favers;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'description', 'url', 'downloads', 'favers'], 'safe'],
		];
	}

	/**
	 * Returns data provider with filled models. Filter applied if needed.
	 * @param array $params
	 * @param array $models
	 * @return \yii\data\ArrayDataProvider
	 */
	public function search($params, $models)
	{
		$dataProvider = new ArrayDataProvider([
			'allModels' => $models,
			'pagination' => [
				'pageSize' => 50,
			],
			'sort' => [
				'attributes' => [], // to be specified
			],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query = new ArrayQuery($models);

		$dataProvider->allModels = $query
			->addCondition('name', 'like ' . $this->name)
			->addCondition('description', 'like ' . $this->description)
			->addCondition('downloads', $this->downloads)
			->addCondition('favers', $this->favers)
			->find();

		return $dataProvider;
	}
}