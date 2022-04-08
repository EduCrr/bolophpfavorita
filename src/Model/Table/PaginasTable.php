<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Collection\Collection;

class PaginasTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('paginas');
		$this->setEntityClass('App\Model\Entity\Pagina');

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
					'message' => 'Por favor, informe o título da página.'
				],
				'descricao' => [
					'message' => 'Por favor, informe a descrição da página.'
				],
				'titulo_compartilhamento' => [
					'message' => 'Por favor, informe o título exibido ao compartilhar.'
				],
				'descricao_compartilhamento' => [
					'message' => 'Por favor, informe a descrição exibida ao compartilhar.'
				],
				'imagem' => [
					'message' => 'Por favor, selecione a imagem.',
					'mode' => 'create',
				]
			]);

		$validator
			->notEmptyString('titulo', 'Por favor, informe o título da página.')
			->add('titulo', 'max-length', [
				'rule' => ['maxLength', 60],
				'message' => 'O título da página deve conter no máximo 60 caracteres.',
			]);

		$validator
			->notEmptyString('descricao', 'Por favor, informe a descrição da página.')
			->add('descricao_pagina', 'max-length', [
				'rule' => ['maxLength', 300],
				'message' => 'A descrição da página deve conter no máximo 300 caracteres.',
			]);

		$validator
			->notEmptyString('titulo_compartilhamento', 'Por favor, informe o título exibido ao compartilhar.')
			->add('titulo_compartilhamento', 'max-length', [
				'rule' => ['maxLength', 60],
				'message' => 'O título exibido ao compartilhar deve conter no máximo 60 caracteres.',
			]);

		$validator
			->notEmptyString('descricao_compartilhamento', 'Por favor, informe a descrição exibida ao compartilhar.')
			->add('descricao_compartilhamento', 'max-length', [
				'rule' => ['maxLength', 300],
				'message' => 'A descrição exibida ao compartilhar deve conter no máximo 300 caracteres.',
			]);

		$validator
			->allowEmptyFile('img', 'Por favor, selecione uma imagem.', 'update')
			->add('img', 'file-type', [
				'rule' => ['mimeType', ['image/jpeg', 'image/png']],
				'message' => 'Os formatos de imagem permitidos são .png e .jpg.'
			])
			->add('img', 'file-extension', [
				'rule' => ['extension', ['png', 'jpg']],
				'message' => 'Os formatos de imagem permitidos são .png e .jpg.'
			])
			->add('img', 'file-size', [
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
				'message' => 'Por favor, selecione a área de recorte da imagem.',
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