<?php

namespace schmunk42\packaii\models\search;

use dosamigos\packagist\Packagist;
use yii\data\ArrayDataProvider;
/**
 *
 * Package model is used to query and display packages from packagist API
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
class Package extends Base
{
	public $maintainers;
	public $versions;
	public $repository;
	public $downloads;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[
				[
					'name',
					'description',
					'time',
					'type',
					'maintainers',
					'versions',
					'repository',
					'downloads',
				],
				'safe'
			],
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

		if(!empty($this->name))
		{
			$api = new Packagist();
			$response = $api->search($this->name, ['tags' => ['yii2-extension']])->getResponse();
			$dataProvider->allModels = $response->getBody();
		}

		return $dataProvider;
	}
} 