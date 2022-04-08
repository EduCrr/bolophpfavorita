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
namespace App\Controller\Manager;

use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenTime;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * Static content controller
 *
 * This controller will render views from templates/Home/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class BlogController extends AppController
{
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);

		$this->FormProtection->setConfig('unlockedActions', ['ordenar']);

		$this->loadModel('Posts');
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
	public function index() {
		$posts = $this->Posts->find('all')
			->where([
				'Posts.excluido IS NULL',
			])
			->order([
				'Posts.ordem' => 'ASC',
				'Posts.id' => 'DESC',
			]);

		$this->set([
			'posts' => $posts,
		]);
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
	public function adicionar() {
		$post = $this->Posts->newEmptyEntity();

		if ($this->request->is('ajax')) {
			$post = $this->Posts->patchEntity($post, $this->request->getData());

			// Exibe os erros que ocorrem ao validar
			if ($post->hasErrors()) {
				$error = $post->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			$post->imagem = md5(uniqid((string) rand(), true)) . '.' . strtolower(pathinfo($this->request->getData('img')->getClientFilename(), PATHINFO_EXTENSION));

			$response = $this->Posts->save($post);
			if ($response) {
				$imagine = new Imagine();

				$image = $imagine->open($this->request->getData('img')->getStream()->getMetadata('uri'));

				$image->crop(new Point(
					(int) $this->request->getData('coordenadas.imagem.padrao.x'),
					(int) $this->request->getData('coordenadas.imagem.padrao.y')
				), new Box(
					(int) $this->request->getData('coordenadas.imagem.padrao.w'),
					(int) $this->request->getData('coordenadas.imagem.padrao.h')
				))
					->resize(new Box(455, 510))
					->save(WWW_ROOT . 'content' . DS . 'posts' . DS . $post->imagem);


				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Registro salvo com sucesso.', 'type' => 'success', 'title' => 'Feito!', 'url' => false)));
			}

			// Exibe os erros que ocorrem ao salvar
			if ($slide->hasErrors()) {
				$error = $slide->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			
			return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
		}

		$this->set([
			'post' => $post,
		]);
	}

	/**
	 * Displays a view
	 *
	 * @param mixed $id
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function editar($id = null) {
		if (!$id) {
			if ($this->request->is('ajax')) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			return $this->redirect(['controller' => 'home', 'action' => 'index']);
		}

		$post = $this->Posts->find('all')
			->where([
				'Posts.excluido IS NULL',
				'Posts.id' => $id,
			], ['Posts.id' => 'string'])
			->first();

		if (!$post) {
			if ($this->request->is('ajax')) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			return $this->redirect(['controller' => 'home', 'action' => 'index']);
		}

		if ($this->request->is('ajax')) {
			$postOriginal = clone $post;

			$post = $this->Posts->patchEntity($post, $this->request->getData());

			// Exibe os erros que ocorrem ao validar
			if ($post->hasErrors()) {
				$error = $post->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

			if ($this->request->getData('img') && $this->request->getData('img')->getError() == 0) {
				$post->imagem = md5(uniqid((string) rand(), true)) . '.' . strtolower(pathinfo($this->request->getData('img')->getClientFilename(), PATHINFO_EXTENSION));
			}

			$response = $this->Posts->save($post);

			if ($response) {
				if ($this->request->getData('img') && $this->request->getData('img')->getError() == 0) {
					if (file_exists(WWW_ROOT . 'content' . DS . 'blog' . DS . 'thumbs' . DS . $postOriginal->imagem)) {
						unlink(WWW_ROOT . 'content' . DS . 'blog' . DS . 'thumbs' . DS . $postOriginal->imagem);
					}

					$imagine = new Imagine();
					$image = $imagine->open($this->request->getData('img')->getStream()->getMetadata('uri'));

					$image->crop(new Point(
						(int) $this->request->getData('coordenadas.imagem.padrao.x'),
						(int) $this->request->getData('coordenadas.imagem.padrao.y')
					), new Box(
						(int) $this->request->getData('coordenadas.imagem.padrao.w'),
						(int) $this->request->getData('coordenadas.imagem.padrao.h')
					))
						->resize(new Box(455, 510))
						->save(WWW_ROOT . 'content' . DS . 'blog' . DS . $post->imagem);
				}

				

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Alterações salvas com sucesso.', 'type' => 'success', 'title' => 'Feito!', 'url' => false)));
			}

			// Exibe os erros que ocorrem ao salvar
			if ($post->hasErrors()) {
				$error = $post->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			
			return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
		}

		

		$this->set([
			'post' => $post,
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

			$exclusao = $this->Posts->query()
				->update()
				->set([
					'excluido' => FrozenTime::now(),
				])
				->where([
					'excluido IS NULL',
					'id' => $id,
				], ['id' => 'string'])
				->execute();

			if ($exclusao->count()) {
				$this->Flash->success('Registro excluído com sucesso.');
			}
			else {
				$this->Flash->success('Não foi possível excluir o registro.');
			}

			return $this->redirect($this->request->referer());
		}

		return $this->redirect(['controller' => 'home', 'action' => 'index']);
	}

	/**
	 * Changes record visibility
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

			$alternancia = $this->Posts->query()
				->update()
				->set([
					'visivel' => (bool) $this->request->getData('visivel'),
				])
				->where([
					'excluido IS NULL',
					'id' => $id,
				], ['id' => 'string'])
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
	 * Sort records
	 *
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
					$registro = $this->Posts->query()
						->update()
						->set([
							'ordem' => FILTER_VAR($key, FILTER_VALIDATE_INT),
						])
						->where([
							'excluido IS NULL',
							'id' => FILTER_VAR($value, FILTER_VALIDATE_INT),
						], ['id' => 'string'])
						->execute();

					$erros[] = $registro->count();
				}
			}

			if (array_filter($erros)) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('type' => 'success')));
			}
			return $this->response->withType('application/json')->withStringBody(json_encode(array('type' => 'error')));
		}

		return $this->redirect($this->request->referer());
	}
}
