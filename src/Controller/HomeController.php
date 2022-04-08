<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\I18n\FrozenTime;
use Cake\Event\EventInterface;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class HomeController extends AppController
{	
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);

		$this->FormProtection->setConfig('unlockedActions', ['carregar']); //mostrar lojas sem button form
	}
	/**
	 * Displays a view
	 *
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
	 *   be found and in debug mode.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found and not in debug mode.
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function index()
	{
		$this->loadModel('Slides');
		$slides = $this->Slides->find('all')
			->where([
				'Slides.excluido is NULL',
			])
			->order([
				'Slides.ordem' => 'ASC',
				'Slides.id' => 'DESC',
			]); //foreach

		$this->loadModel('Estilos');
		$estilos = $this->Estilos->find('all')
			->where([
				'Estilos.excluido is NULL',
			])
			->order([
				'Estilos.ordem' => 'ASC',
				'Estilos.id' => 'DESC',
			]);	

		$this->loadModel('Estados');
		$this->set([
			'estados' => $this->Estados->find('list', [
				'keyField' => 'state_id',
				'valueField' => 'state',
			])
			->toArray(), // n para usar foreach pq retorna array
		]);

		$this->set([
			'slides' => $slides,
			'estilos' => $estilos,
		]);		
	}

	//lojas
	public function carregar()
	{
		if ($this->request->is('ajax')) {
			$entity = $this->Lojas->newEntity($this->request->getData());
			$validator = $this->Lojas->getValidator('find');

			$error = $validator->validate($this->request->getData());

			if ($error) {
				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			$cidade = $this->request->getData('cidade'); //dados do form da view enviada ajax

			$estado = $this->request->getData('estado_id');

			$lojas = $this->Lojas->find('all')
				->where([
					'Lojas.segmento' => 'EXCLUSIVO',
					'Lojas.PDV' => 'S',
					'Lojas.marca' => 'newmoveis',
				])
				->contain([
					'Cidades' => [
						'Estados',
					]
				])
				->matching('Cidades', function(Query $q) use($cidade) {
					return $q->find('all')
						->where([
							'Cidades.city_id' => $cidade, //pegar cidades
						]);
				});

			$lojas_estado = $this->Lojas->find('all')
				->where([
					'Lojas.segmento' => 'EXCLUSIVO',
					'Lojas.PDV' => 'S',
					'Lojas.marca' => 'newmoveis',
				])
				->contain([
					'Estados' => [
						'Cidades',
					]
				])
				->matching('Estados', function(Query $q) use($estado) {
					return $q->find('all')
						->where([
							'Estados.state_id' => $estado,
						]);
				});

			$this->set([
				'lojas' => $lojas,
				'lojas_estado' => $lojas_estado,
			]);
		}
		else {
			return $this->redirect(['controller' => 'home', 'action' => 'index']);
		}
	}
}