<?php

namespace schmunk42\packaii\models\search;

use yii\base\Model;
use yii\helpers\Inflector;
/**
 *
 * Base class is where all search models extend from.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
class Base extends Model
{
	/**
	 * @var string the name of the package
	 */
	public $name;
	/**
	 * @var string the description of the package
	 */
	public $description;
	/**
	 * @var string the datetime
	 */
	public $time;
	/**
	 * @var string the type
	 */
	public $type;

	/**
	 * Sets the attribute values in a massive way.
	 * @param array $values attribute values (name => value) to be assigned to the model.
	 * @param boolean $safeOnly whether the assignments should only be done to the safe attributes.
	 * A safe attribute is one that is associated with a validation rule in the current [[scenario]].
	 * @see safeAttributes()
	 * @see attributes()
	 */
	public function setAttributes($values, $safeOnly = true)
	{
		if (is_array($values)) {
			$attributes = array_flip($safeOnly ? $this->safeAttributes() : $this->attributes());
			foreach ($values as $name => $value) {
				$name = Inflector::variablize($name);
				if (isset($attributes[$name])) {
					$this->$name = $value;
				} elseif ($safeOnly) {
					$this->onUnsafeAttribute($name, $value);
				}
			}
		}
	}

} 