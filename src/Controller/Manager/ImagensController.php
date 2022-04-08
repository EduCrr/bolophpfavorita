<?php
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
namespace App\Controller\Manager;

use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3/en/controllers/pages-controller.html
 */
class ImagensController extends AppController
{	
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);

		$this->FormProtection->setConfig('unlockedActions', ['ordenar']);

		$this->loadModel('Imagens');
	}

	/**
	 * Displays a view
	 *
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function visualizar($id = null) {
		if (!$id) {
			if ($this->request->is(['ajax'])) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			return $this->redirect(['controller' => 'ambientes', 'action' => 'index']);
		}

		$this->loadModel('Ambientes');
		$ambiente = $this->Ambientes->find()
			->where([
				'Ambientes.excluido IS NULL',
				'Ambientes.id' => $id,
			])
			->contain([
				'Imagens' => [
					'sort' => [
						'Imagens.ordem' => 'ASC',
						'Imagens.id' => 'DESC',
					]
				]
			])
			->first();

		if (!$ambiente) {
			if ($this->request->is(['ajax'])) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			return $this->redirect(['controller' => 'ambientes', 'action' => 'index']);
		}

		if ($this->request->is(['ajax'])) {
			$imagem = $this->Imagens->newEntity($this->request->getData());

			// Exibe os erros que ocorrem ao validar
			if ($imagem->hasErrors()) {
				$error = $imagem->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			$imagem->nome = md5(uniqid((string) rand(), true)) . '.' . strtolower(pathinfo($this->request->getData('img')->getClientFilename(), PATHINFO_EXTENSION));
			$imagem->ambiente = $ambiente; //pegando id e salvado em ambiente_id

			$response = $this->Imagens->save($imagem);
			if ($response) {
				$imagine = new Imagine();
				$image = $imagine->open($this->request->getData('img')->getStream()->getMetadata('uri'));

				$size = $image->getSize();
				
				if ($size->getWidth() > $size->getHeight()) {
					$newW = $size->getWidth() * 330 / $size->getHeight();
					$newH = 330;

					if ($newW < 610) {
						$newH = (610 / $newW) * $newH;
						$newW = 610;
					}

					$image->resize(new Box($newW, $newH));
					$size = $image->getSize();
					$image = $image->crop(new Point($size->getWidth() / 2 - 610 / 2, 0), new Box(610, 330));
				}
				else {
					$newH = $size->getHeight() * 610 / $size->getWidth();
					$newW = 610;

					if ($newH < 330) {
						$newW = (330 / $newH) * $newW;
						$newH = 330;						
					}

					$image->resize(new Box($newW, $newH));
					$size = $image->getSize();
					$image = $image->crop(new Point(0, $size->getHeight() / 2 - 330 / 2), new Box(610, 330));
				}

				$image->save(WWW_ROOT . 'content' . DS . 'ambients' . DS . 'gallery' . DS . 's' . DS . $imagem->nome);

				$this->request->getData('img')->moveTo(WWW_ROOT . 'content' . DS . 'ambients' . DS . 'gallery' . DS . 'b' . DS . $imagem->nome);

				$this->viewBuilder()->setLayout('ajax');
				$this->set([
					'imagem' => $imagem,
				]);

				return $this->render('imagem');
			}

			// Exibe os erros que ocorrem ao salvar
			if ($imagem->hasErrors()) {
				$error = $imagem->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			
			return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
		}

		$this->set([
			'ambiente' => $ambiente,
		]);
	}

	/**
	 * Delete the record
	 *
	 * @param mixed $id
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function excluir($id = null) {
		if ($this->request->is(['post'])) {
			if (!$id) {
				return $this->redirect($this->request->referer());
			}

			$imagem = $this->Imagens->find('all')
				->where([
					'Imagens.excluido IS NULL',
					'Imagens.id' => $id,
				], ['Imagens.id' => 'string'])
				->first();

			if (!$imagem) {
				return $this->redirect($this->request->referer());
			}

			$imagem->excluido = FrozenTime::now();

			$this->Imagens->removeBehavior('Timestamp');

			if ($this->Imagens->save($imagem)) {
				$this->Flash->success('Registro excluído com sucesso.');
			}
			else {
				$this->Flash->success('Não foi possível excluir o registro.');
			}

			return $this->redirect($this->request->referer());
		}

		return $this->redirect(['controller' => 'ambientes', 'action' => 'index']);
	}

	/**
	 * Changes the visibility of the record 
	 *
	 * @param mixed $id
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function visibilidade($id = null) {
		if ($this->request->is(['ajax'])) {
			if (!$id) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('type' => 'error')));
			}

			$alternancia = $this->Imagens->query()
				->update()
				->set([
					'visivel' => (bool) $this->request->getData('visivel'),
				])
				->where([
					'excluido IS NULL',
					'id' => FILTER_VAR($id, FILTER_VALIDATE_INT),
				])
				->execute();

			if ($alternancia->count()) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('type' => 'success', 'active' => (bool) $this->request->getData('visivel'))));
			}
			else {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('type' => 'error')));
			}
		}

		return $this->redirect($this->request->referer());
	}

	/**
	 * Changes the order of the elements
	 *
	 * @param mixed $id
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function ordenar() {
		if ($this->request->is(['ajax'])) {
			$erros = [];

			if ($this->request->getData('odr') && is_array($this->request->getData('odr'))) {
				foreach ($this->request->getData('odr') as $key => $value) {
					$imagem = $this->Imagens->query()
						->update()
						->set([
							'ordem' => FILTER_VAR($key, FILTER_VALIDATE_INT),
						])
						->where([
							'excluido IS NULL',
							'id' => FILTER_VAR($value, FILTER_VALIDATE_INT),
						], ['id' => 'string'])
						->execute();

					$erros[] = $imagem->count();
				}
			}

			if (array_filter($erros)) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('type' => 'success')));
			}
			return $this->response->withType('application/json')->withStringBody(json_encode(array('type' => 'error')));
		}

		return $this->redirect($this->request->referer());
	}

	/**
	 * Crop image file
	 *
	 * @param mixed $id
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function cortar($id = null) {
		if ($this->request->is(['ajax'])) {
			if (!$id) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			$imagem = $this->Imagens->find()
				->where([
					'Imagens.excluido IS NULL',
					'Imagens.id' => $id,
				])
				->matching('Ambientes', function(Query $q) {
					return $q->find('all')
						->where([
							'Ambientes.excluido IS NULL',
						]);
				})
				->first();

			if (!$imagem) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			$imagem = $this->Imagens->patchEntity($imagem, $this->request->getData(), [
				'validation' => 'crop',
			]);

			// Exibe os erros que ocorrem ao validar
			if ($imagem->hasErrors()) {
				$error = $imagem->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			if (file_exists(WWW_ROOT . 'content' . DS . 'ambients' . DS . 'gallery' . DS . 's' . DS . $imagem->img)) {
				unlink(WWW_ROOT . 'content' . DS . 'ambients' . DS . 'gallery' . DS . 's' . DS . $imagem->img);
			}

			$imagine = new Imagine();
			$image = $imagine->open(WWW_ROOT . 'content' . DS . 'ambients' . DS . 'gallery' . DS . 'b' . DS . $imagem->img);

			$image->crop(new Point(
					(int) $this->request->getData('coordenadas.desktop.x'),
					(int) $this->request->getData('coordenadas.desktop.y')
				), new Box(
					(int) $this->request->getData('coordenadas.desktop.w'),
					(int) $this->request->getData('coordenadas.desktop.h')
				))
					->resize(new Box(480, 680));

				$image->save(WWW_ROOT . 'content' . DS . 'ambients' . DS . 'gallery' . DS . 's' . DS . $imagem->img);

			return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Alterações salvas com sucesso.', 'type' => 'success', 'title' => 'Feito!', 'url' => false)));
		}
		else {
			return $this->redirect(['controller' => 'ambientes', 'action' => 'index']);
		}
	}

	/**
	 * Update caption image
	 *
	 * @param mixed $id
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function editar($id = null) {
		if ($this->request->is(['ajax'])) {
			if (!$id) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			$imagem = $this->Imagens->find()
				->where([
					'Imagens.excluido IS NULL',
					'Imagens.id' => $id,
				])
				->matching('Ambientes', function(Query $q) {
					return $q->find('all')
						->where([
							'Ambientes.excluido IS NULL',
						]);
				})
				->first();

			if (!$imagem) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			$imagem = $this->Imagens->patchEntity($imagem, $this->request->getData(), [
				'validation' => false,
			]);

			// Exibe os erros que ocorrem ao validar
			if ($imagem->hasErrors()) {
				$error = $imagem->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			$response = $this->Imagens->save($imagem);
			if ($response) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Alterações salvas com sucesso.', 'type' => 'success', 'title' => 'Feito!', 'url' => false)));
			}

			// Exibe os erros que ocorrem ao salvar
			if ($imagem->hasErrors()) {
				$error = $imagem->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
		}
		else {
			return $this->redirect(['controller' => 'ambientes', 'action' => 'index']);
		}
	}
}