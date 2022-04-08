<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CidadesTable extends Table {

	public static function defaultConnectionName(): string
	{
		return 'stores';
	}

	public function initialize(Array $config): void
	{
		$this->setTable('cities');
		$this->setPrimaryKey('city_id');
		$this->setEntityClass('App\Model\Entity\Cidade');

		$this->belongsTo('Estados', [
			'className' => 'Estados',
			'foreignKey' => 'uf_id',
		]);

		$this->hasMany('Lojas', [
			'className' => 'Lojas',
			'foreignKey' => 'id_cidade',
			'sort' => [
				'Lojas.razao',
			],
		]);
	}
}