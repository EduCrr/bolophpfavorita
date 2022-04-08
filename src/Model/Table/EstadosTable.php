<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class EstadosTable extends Table {

	public static function defaultConnectionName(): string
	{
		return 'stores';
	}

	public function initialize(Array $config): void
	{
		$this->setTable('states');
		$this->setPrimaryKey('state_id');
		$this->setEntityClass('App\Model\Entity\Cidade');

		$this->hasMany('Cidades', [
			'className' => 'Cidades',
			'foreignKey' => 'uf_id',
			'sort' => [
				'Cidades.city' => 'ASC',
			]
		]);

		$this->hasMany('Lojas', [
			'className' => 'Lojas',
			'foreignKey' => 'id_uf',
			'sort' => [
				'Lojas.razao',
			],
		]);
	}
}