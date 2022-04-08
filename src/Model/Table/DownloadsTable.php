<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\Collection\Collection;
use Cake\Datasource\FactoryLocator;
use Cake\Event\EventInterface;
use Cake\Utility\Text;

class DownloadsTable extends Table {
	public function initialize(Array $config): void
	{
		$this->setTable('downloads');
		$this->setEntityClass('App\Model\Entity\Download');

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
				'message' => 'Por favor, informe o nome',
			],
			// 'linha_id' => [
			// 	'message' => 'Por favor, informe a linha correspondente',
			// ],
		]);

		$validator
		->notEmptyString('nome', 'Por favor, informe o nome');

		// $validator
		// ->notEmptyString('linha_id', 'Por favor, informe a linha correspondente');

		// ->add('arq', 'file-type', [
		// 	'rule' => ['mimeType', [
		// 		'application/pdf',
		// 		'application/msword',
		// 		'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
		// 	]],
		// 	'message' => 'Os formatos permitodos são PDF, DOC e DOCX.'
		// ])
		// ->add('arq', 'file-size', [
		// 	'rule' => ['fileSize', '<=', '10MB'],
		// 	'message' => 'O tamanho máximo permitido é de 10mb.',
		// ]);

		return $validator;
	}

		public function beforeSave(EventInterface $event, $entity, $options)
	{
		$sluggedTitle = Text::slug($entity->nome);
		$conditions = [
			'Downloads.excluido IS NULL',
		];
		if (!$entity->isNew()) {
			$conditions['Downloads.id <>'] = $entity->id;
		}

		$filename = $entity->arquivo;
		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$total = 0;
		do {
			$newSluggedTitle  = $sluggedTitle . ($total > 0 ? '-' . $total : null);
			$conditions['Downloads.slug'] = $newSluggedTitle;

			$slugs = $this->find('all')
				->where($conditions)
				->count();

			$total++;
		} while ($slugs > 0);

		$entity->slug = mb_strtolower($newSluggedTitle) . '.' . $extension;
	}
}