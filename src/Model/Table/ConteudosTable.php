<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Collection\Collection;

class ConteudosTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('conteudos');
		$this->setEntityClass('App\Model\Entity\Conteudo');

		$this->hasOne('Parametros', [
			'className' => 'Parametros',
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

	public function validationDefault(Validator $validator): Validator
	{
		$validator
			->requirePresence([
				'titulo' => [
					'message' => 'Por favor, informe o título.',
				],
				'texto' => [
					'message' => 'Por favor, informe o texto.',
				],
			]);

		$validator
			->notEmptyString('titulo', 'Por favor, informe o título.');

		$validator
			->notEmptyString('texto', 'Por favor, informe o texto.');

		$validator
			->allowEmptyFile('imagem')
			->add('imagem', 'file-type', [
				'rule' => ['mimeType', ['image/jpeg', 'image/png']],
				'message' => 'Os formatos de imagem permitidos são .png e .jpg.'
			])
			->add('imagem', 'file-extension', [
				'rule' => ['extension', ['png', 'jpg']],
				'message' => 'Os formatos de imagem permitidos são .png e .jpg.'
			])
			->add('imagem', 'file-size', [
				'rule' => ['fileSize', '<=', '2MB'],
				'message' => 'O tamanho da imagem deve ser menor que 2MB.',
			]);

		$validator
			->add('coordenadas', 'valid-array-desktop', [
				'rule' => function($value, $context) {
					return isset($value['desktop']);
				},
				'on' => function ($context) {
					return isset($context['data']['img']) && $context['data']['img'] instanceof \Laminas\Diactoros\UploadedFile && $context['data']['img']->getError() == 0;
				},
				'message' => 'Por favor, selecione a área de recorte da img.',
			])
			->add('coordenadas', 'not-empty-array-desktop', [
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
				'on' => function ($context) {
					return isset($context['data']['img']) && $context['data']['img'] instanceof \Laminas\Diactoros\UploadedFile && $context['data']['img']->getError() == 0;
				},
				'message' => 'Ocorreu um erro. Atualize a página e tente novamente.',
			]);

		return $validator;
	}
}