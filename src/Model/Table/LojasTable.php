<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class LojasTable extends Table {

	public static function defaultConnectionName(): string
	{
		return 'stores';
	}

	public function initialize(Array $config): void
	{
		$this->setTable('unicasa_pdvs_ativos');
		$this->setPrimaryKey('estab_id');
		$this->setEntityClass('App\Model\Entity\Loja');

		$this->belongsTo('Cidades', [
			'className' => 'Cidades',
			'propertyName' => 'PDVs',
			'foreignKey' => 'id_cidade',
		]);

		$this->belongsTo('Estados', [
			'className' => 'Estados',
			'propertyName' => 'PDVs',
			'foreignKey' => 'id_uf',
		]);
	}

	public function validationFind(Validator $validator): Validator
	{
		$validator
			->requirePresence([
				'estado_id' => [
					'message' => 'Por favor, selecione o estado.',
				],
				'cidade' => [
					'message' => 'Por favor, selecione a cidade.',
				],
			]);

		$validator
			->notEmptyString('estado_id', 'Por favor, selecione o estado.');

		$validator
			->notEmptyString('cidade', 'Por favor, selecione a cidade.');

		return $validator;
	}
}