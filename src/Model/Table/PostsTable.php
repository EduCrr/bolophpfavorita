<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\Collection\Collection;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Cake\Utility\Text;

class PostsTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('posts');
		$this->setEntityClass('App\Model\Entity\Post');

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
				'conteudo' => [
					'message' => 'Por favor, informe o conteúdo.',
				],
				'img' => [
					'message' => 'Por favor, selecione uma imagem.',
					'mode' => 'create',
				],
				'publicado' => [
					'message' => 'Ocorreu um erro. Atualize a página e tente novamente.',
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
			->notEmptyString('titulo', 'Por favor, informe o título.');

		$validator
			->notEmptyString('conteudo', 'Por favor, informe o conteúdo.');

		
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
			->add('coordenadas', 'valid-array-default', [
				'rule' => function($value, $context) {
					return isset($value['imagem']['padrao']);
				},
				'on' => function ($context) {
					return isset($context['data']['img']) && $context['data']['img'] instanceof \Laminas\Diactoros\UploadedFile && $context['data']['img']->getError() == 0;
				},
				'message' => 'Por favor, selecione a área de recorte da imagem.',
			])
			->add('coordenadas', 'not-empty-array-default', [
				'rule' => function($value, $context) {
					if (!isset($value['imagem']['padrao']) || array_diff_key(array_flip(['w', 'h']), $value['imagem']['padrao'])) {
						return false;
					}

					$collection = new Collection($value['imagem']['padrao']);
					
					$filtered = $collection->filter(function ($val, $key) {
						return (filter_var($val, FILTER_VALIDATE_FLOAT)) !== false;
					});

					return count($value['imagem']['padrao']) == $filtered->count() && $value['imagem']['padrao']['w'] > 0 && $value['imagem']['padrao']['h'] > 0;
				},
				'on' => function ($context) {
					return isset($context['data']['img']) && $context['data']['img'] instanceof \Laminas\Diactoros\UploadedFile && $context['data']['img']->getError() == 0;
				},
				'message' => 'Ocorreu um erro. Atualize a página e tente novamente.',
			]);

		$validator
			->allowEmptyString('publicado')
			->add('publicado', 'valid-value', [
				'rule' => ['custom', '/^([0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4})([ ]{1})([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
				'message' => 'Por favor, informe uma data válida.',
			])
			->add('publicado', 'valid-value-2', [
				'rule' => ['datetime', 'dmy'],
				'message' => 'Por favor, informe uma data válida.',
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
		$sluggedTitle = Text::slug($entity->titulo);
		$conditions = [
			'Posts.excluido IS NULL',
		];
		if (!$entity->isNew()) {
			$conditions['Posts.id <>'] = $entity->id;
		}

		$total = 0;
		do {
			$newSluggedTitle  = $sluggedTitle . ($total > 0 ? '-' . $total : null);
			$conditions['Posts.slug'] = $newSluggedTitle;

			$slugs = $this->find('all')
				->where($conditions)
				->count();

			$total++;
		} while ($slugs > 0);

		$entity->slug = mb_strtolower($newSluggedTitle);
	}
}