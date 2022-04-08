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
use Cake\ORM\Query;
use Cake\I18n\FrozenTime;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class DownloadsController extends AppController
{
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);

		$this->FormProtection->setConfig('unlockedActions', ['visibilidade', 'ordenar']);
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
	public function index()	{
		$this->loadModel('Downloads');
		$downloads = $this->Downloads->find('all')
		->where([
			'Downloads.excluido IS NULL',
		])
		->order([
			'Downloads.ordem' => 'ASC',
			'Downloads.id' => 'DESC',
		]);

		$this->set([
			'downloads' => $downloads,
		]);
	}

	/**
	 * Download a file
	 *
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
	 *   be found and in debug mode.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found and not in debug mode.
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function download($id = null) {
		$this->loadModel('Downloads');
		$download = $this->Downloads->find('all')
		->where([
			'Downloads.id' => $id,
		], ['Downloads.id' => 'string'])
		->first();

		$filename = $download->arquivo;
		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		return $this->response->withFile(
			WWW_ROOT . 'content' . DS . 'downloads' . DS . 'files' . DS . $download->arquivo,
			['download' => true, 'name' => $download->nome . '.' . $extension]
		);

		return $this->redirect($this->request->referer());	
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
		$download = $this->Downloads->newEmptyEntity();

		if ($this->request->is('ajax')) {
			$download = $this->Downloads->patchEntity($download, $this->request->getData());

			// Exibe os erros que ocorrem ao validar
			if ($download->hasErrors()) {
				$error = $download->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}

				$download->arquivo = md5(uniqid((string) rand(), true)) . '.' . strtolower(pathinfo($this->request->getData('arq')->getClientFilename(), PATHINFO_EXTENSION));

				$response = $this->Downloads->save($download);

			if ($response) {

				$this->request->getData('arq')->moveTo(WWW_ROOT . 'content' . DS . 'downloads' . DS . 'files' . DS . $download->arquivo);

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Alterações salvas com sucesso.', 'type' => 'success', 'title' => 'Feito!', 'url' => false)));
			}

			// Exibe os erros que ocorrem ao salvar
			if ($download->hasErrors()) {
				$error = $download->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			
			return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
		}

		$this->set([
			'download' => $download,
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
			return $this->redirect(['controller' => 'downloads', 'action' => 'index']);
		}

		$this->loadModel('Downloads');
		$download = $this->Downloads->find('all')
			->where([
				'Downloads.excluido IS NULL',
				'Downloads.id' => $id,
			], ['Downloads.id' => 'string'])
			->first();

		if (!$download) {
			if ($this->request->is('ajax')) {
				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			return $this->redirect(['controller' => 'downloads', 'action' => 'index']);
		}

		if ($this->request->is('ajax')) {
			$download = $this->Downloads->patchEntity($download, $this->request->getData());

			if ($this->request->getData('arq') && $this->request->getData('arq')->getError() == 0) {
				$download->arquivo = md5(uniqid((string) rand(), true)) . '.' . strtolower(pathinfo($this->request->getData('arq')->getClientFilename(), PATHINFO_EXTENSION));
			}

			$response = $this->Downloads->save($download);
			if ($response) {
				
				if ($this->request->getData('arq') && $this->request->getData('arq')->getError() == 0) {
					if ($download->arquivo && file_exists(WWW_ROOT . 'content' . DS . 'downloads' . DS . 'files' . DS . $download->arquivo)) {
						unlink(WWW_ROOT . 'content' . DS . 'files' . DS . $download->arquivo);
					}

					$this->request->getData('arq')->moveTo(WWW_ROOT . 'content' . DS . 'downloads' . DS . 'files' . DS . $download->arquivo);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Alterações salvas com sucesso.', 'type' => 'success', 'title' => 'Feito!', 'url' => false)));
				
			}

			// Exibe os erros que ocorrem ao salvar
			if ($download->hasErrors()) {
				$error = $download->getErrors();

				while (is_array($error) && $error) {
					$error = array_shift($error);
				}

				return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => $error, 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
			}
			
			return $this->response->withType('application/json')->withStringBody(json_encode(array('msg' => 'Não foi possível salvar as informações. Tente novamente mais tarde.', 'type' => 'error', 'title' => 'Oops...', 'url' => false)));
		}

		$this->set([
			'download' => $download,
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

			$exclusao = $this->Downloads->query()
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

		return $this->redirect(['controller' => 'downloads', 'action' => 'arquivos3d']);
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

			$alternancia = $this->Downloads->query()
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
					$registro = $this->Downloads->query()
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

	public function excluirArquivo($id = null) {
		if ($this->request->is(['post', 'put'])) {
			if (!$id) {
				return $this->redirect($this->request->referer());
			}

			$arquivo3d = $this->Downloads->find('all')
				->where([
					'Downloads.id' => $id,
				])
				->contain([
					'Parametros',
				])
				->first();


			if (!$arquivo3d) {
				return $this->redirect($this->request->referer());
			}

			$arquivo = $arquivo3d->arquivo;
			$arquivo3d->arquivo = null;

			if ($this->Downloads->save($arquivo3d)) {
				unlink(WWW_ROOT . 'content' . DS . 'downloads' . DS . 'files' . DS . $arquivo);

				$this->Flash->success('Arquivo excluído com sucesso.');
				return $this->redirect($this->request->referer());
			}
		}

		// return $this->redirect(['controller' => 'downloads', 'action' => 'index']);
	}
}