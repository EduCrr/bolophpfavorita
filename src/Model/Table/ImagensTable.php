<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Collection\Collection;

class ImagensTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('imagens');
		$this->setEntityClass('App\Model\Entity\Imagem');

		$this->belongsTo('Ambientes', [
			'className' => 'Ambientes',
			'foreignKey' => 'ambiente_id',
			'conditions' => [
				'Ambientes.excluido IS NULL',
			]
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

	public function validationDefault(Validator $validator): Validator
	{
		$validator
			->requirePresence([
				'img' => [
					'message' => 'Por favor, selecione uma imagem.',
					'mode' => 'create',
				],
			]);

		$validator
			->allowEmptyFile('img', 'Por favor, selecione uma imagem.', 'update')
			->add('img', 'file-type', [
				'rule' => ['mimeType', [
					'image/jpeg',
					'image/png',
				]],
				'message' => 'Os formatos de imagem permitidos são .png e .jpg.'
			])
			->add('img', 'file-size', [
				'rule' => ['fileSize', '<=', '2MB'],
				'message' => 'O tamanho da imagem deve ser menor que 2MB.',
			])
			/*->add('img', 'file-width', [
				'rule' => ['imageWidth', '<=', 1920],
				'message' => 'A largura da imagem deve ser menor que 1920px.',
				'last' => true,
			])
			->add('img', 'file-height', [
				'rule' => ['imageHeight', '<=', 1080],
				'message' => 'A altura da imagem deve ser menor que 1080px.',
			])*/;


		return $validator;
	}

	public function validationCrop(Validator $validator): Validator
	{
		$validator
			->add('coordenadas', 'valid-array', [
				'rule' => function($value, $context) {
					return isset($value['desktop']);
				},
				'message' => 'Por favor, selecione a área de recorte da imagem.',
			])
			->add('coordenadas', 'not-empty-array', [
				'rule' => function($value, $context) {
					if (!isset($value['desktop']) || array_diff_key(array_flip(['w', 'h']), $value['desktop'])) {
						return false;
					}

					$collection = new Collection($value['desktop']);
					
					$filtered = $collection->filter(function ($val, $key) {
						return (filter_var($val, FILTER_VALIDATE_FLOAT)) !== false;
					});

					return count($value['desktop']) == $filtered->count() && $value['desktop']['w'] > 0 && $value['desktop']['h'] > 0;
				},
				'message' => 'Ocorreu um erro. Atualize a página e tente novamente.',
			]);

		return $validator;
	}
}