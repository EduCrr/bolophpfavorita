<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\Collection\Collection;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Cake\Utility\Text;

class EstilosTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('estilos');
		$this->setEntityClass('App\Model\Entity\Estilo');

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

		//validando campos form
		$validator
			->requirePresence([
				'nome' => [
					'message' => 'Por favor, informe o título.',
				],
				'descricao' => [
					'message' => 'Por favor, informe o conteúdo.',
				],
				'img' => [
					'message' => 'Por favor, selecione uma imagem.',
					'mode' => 'create',
				],
			]);

		$validator
			->notEmptyString('nome', 'Por favor, informe o nome.');

		$validator
			->notEmptyString('descricao', 'Por favor, informe a descrição.');

		
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

		

		return $validator;
	}

	
}