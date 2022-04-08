<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\Collection\Collection;
use Cake\Datasource\FactoryLocator;
use Cake\Utility\Text;
use Cake\Event\EventInterface;

class AmbientesTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('ambientes');
		$this->setEntityClass('App\Model\Entity\Ambiente');

		$this->hasMany('Imagens', [
			'className' => 'Imagens',
			'foreignKey' => 'ambiente_id',
			'conditions' => [
				'Imagens.excluido IS NULL',
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
				'nome' => [
					'message' => 'Por favor, informe o nome.',
				],
				'img' => [
					'message' => 'Por favor, selecione uma imagem.',
					'mode' => 'create',
				],
				'img_banner' => [
					'message' => 'Por favor, selecione uma imagem.',
					'mode' => 'create',
				],
				'estilo' => [
					'message' => 'Por favor, informe a estilo.',
				],
				'descricao' => [
					'message' => 'Por favor, informe a descrição.',
				],
				'titulo_pagina' => [
					'message' => 'Por favor, informe o título da página.'
				],
				'descricao_pagina' => [
					'message' => 'Por favor, informe a descrição da página.'
				],
				'titulo_compartilhamento' => [
					'message' => 'Por favor, informe o título exibido ao compartilhar.'
				],
				'descricao_compartilhamento' => [
					'message' => 'Por favor, informe a descrição exibida ao compartilhar.'
				]
			]);

		$validator
			->notEmptyString('nome', 'Por favor, informe o nome.');

		$validator
			->allowEmptyFile('img_banner', 'Por favor, selecione uma imagem.', 'update')
			->add('img_banner', 'file-type', [
				'rule' => ['mimeType', ['image/jpeg', 'image/png']],
				'message' => 'Os formatos de imagem permitidos são .png e .jpg.'
			])
			->add('img_banner', 'file-extension', [
				'rule' => ['extension', ['png', 'jpg']],
				'message' => 'Os formatos de imagem permitidos são .png e .jpg.'
			])
			->add('img_banner', 'file-size', [
				'rule' => ['fileSize', '<=', '2MB'],
				'message' => 'O tamanho da imagem deve ser menor que 2MB.',
			]);

		$validator
			->add('coordenadas', 'valid-array-desktop', [
				'rule' => function($value, $context) {
					return isset($value['imagem']['banner']);
				},
				'on' => function ($context) {
					return isset($context['data']['img_banner']) && $context['data']['img_banner'] instanceof \Laminas\Diactoros\UploadedFile && $context['data']['img_banner']->getError() == 0;
				},
				'message' => 'Por favor, selecione a área de recorte da imagem.',
			])
			->add('coordenadas', 'not-empty-array-desktop', [
				'rule' => function($value, $context) {
					if (!isset($value['imagem']['banner']) || array_diff_key(array_flip(['w', 'h']), $value['imagem']['banner'])) {
						return false;
					}

					$collection = new Collection($value['imagem']['banner']);
					
					$filtered = $collection->filter(function ($val, $key) {
						return (filter_var($val, FILTER_VALIDATE_FLOAT)) !== false;
					});

					return count($value['imagem']['banner']) == $filtered->count() && $value['imagem']['banner']['w'] > 0 && $value['imagem']['banner']['h'] > 0;
				},
				'on' => function ($context) {
					return isset($context['data']['img_banner']) && $context['data']['img_banner'] instanceof \Laminas\Diactoros\UploadedFile && $context['data']['img_banner']->getError() == 0;
				},
				'message' => 'Ocorreu um erro. Atualize a página e tente novamente.',
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
					return isset($value['imagem']['desktop']);
				},
				'on' => function ($context) {
					return isset($context['data']['img']) && $context['data']['img'] instanceof \Laminas\Diactoros\UploadedFile && $context['data']['img']->getError() == 0;
				},
				'message' => 'Por favor, selecione a área de recorte da imagem.',
			])
			->add('coordenadas', 'not-empty-array-desktop', [
				'rule' => function($value, $context) {
					if (!isset($value['imagem']['desktop']) || array_diff_key(array_flip(['w', 'h']), $value['imagem']['desktop'])) {
						return false;
					}

					$collection = new Collection($value['imagem']['desktop']);
					
					$filtered = $collection->filter(function ($val, $key) {
						return (filter_var($val, FILTER_VALIDATE_FLOAT)) !== false;
					});

					return count($value['imagem']['desktop']) == $filtered->count() && $value['imagem']['desktop']['w'] > 0 && $value['imagem']['desktop']['h'] > 0;
				},
				'on' => function ($context) {
					return isset($context['data']['img']) && $context['data']['img'] instanceof \Laminas\Diactoros\UploadedFile && $context['data']['img']->getError() == 0;
				},
				'message' => 'Ocorreu um erro. Atualize a página e tente novamente.',
			]);
				
		$validator
			->notEmptyString('estilo', 'Por favor, informe o estilo.')
			->add('estilo', 'max-length', [
				'rule' => ['maxLength', 150],
				'message' => 'O estilo deve conter no máximo 150 caracteres.',
			]);

		$validator
			->notEmptyString('descricao', 'Por favor, informe a descrição.')
			->add('descricao', 'max-length', [
				'rule' => ['maxLength', 300],
				'message' => 'A descrição deve conter no máximo 300 caracteres.',
			]);

		$validator
			->notEmptyString('titulo_pagina', 'Por favor, informe o título da página.')
			->add('titulo_pagina', 'max-length', [
				'rule' => ['maxLength', 60],
				'message' => 'O título da página deve conter no máximo 60 caracteres.',
			]);

		$validator
			->notEmptyString('descricao_pagina', 'Por favor, informe a descrição da página.')
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

		return $validator;
	}

	public function beforeSave(EventInterface $event, $entity, $options)
	{
		$sluggedTitle = Text::slug($entity->nome);
		$conditions = [
			'Ambientes.excluido IS NULL',
		];
		if (!$entity->isNew()) {
			$conditions['Ambientes.id <>'] = $entity->id;
		}

		$total = 0;
		do {
			$newSluggedTitle  = $sluggedTitle . ($total > 0 ? '-' . $total : null);
			$conditions['Ambientes.slug'] = $newSluggedTitle;

			$slugs = $this->find('all')
				->where($conditions)
				->count();

			$total++;
		} while ($slugs > 0);

		$entity->slug = mb_strtolower($newSluggedTitle);
	}
}