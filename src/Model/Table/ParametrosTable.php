<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ParametrosTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('conteudos_parametros');
		$this->setEntityClass('App\Model\Entity\Parametro');

		$this->belongsTo('Conteudos', [
			'className' => 'Conteudos',
			'foreignKey' => 'conteudo_id',
		]);

		$this->addBehavior('Timestamp', [
			'events' => [
				'Model.beforeSave' => [
					'criado' => 'new',
					'modificado' => 'existing',
				],
			]
		]);
	}
}