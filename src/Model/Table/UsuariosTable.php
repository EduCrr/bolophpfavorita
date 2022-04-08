<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class UsuariosTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('usuarios');
		$this->setEntityClass('App\Model\Entity\Usuario');

		$this->addBehavior('Timestamp', [
			'events' => [
				'Model.beforeSave' => [
					'criado' => 'new',
					'modificado' => 'existing',
				],
			]
		]);
	}

	public function findAuth(\Cake\ORM\Query $query, array $options) {
		$query
			->where([
				'Usuarios.excluido IS NULL',
			]);

		return $query;
	}
}