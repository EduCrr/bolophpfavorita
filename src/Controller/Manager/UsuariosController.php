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

use Cake\Routing\Router;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3/en/controllers/pages-controller.html
 */
class UsuariosController extends AppController {
	
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);

		$this->Authentication->allowUnauthenticated(['login']);
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
	public function login() {
		$this->viewBuilder()->setLayout('auth');

		$this->request->allowMethod(['get', 'post']);
		$result = $this->Authentication->getResult();

		// regardless of POST or GET, redirect if user is logged in
		if ($result->isValid()) {
			$target = $this->Authentication->getLoginRedirect() ?? ['controller' => 'home', 'action' => 'index'];

	        return $this->redirect($target);
		}
		
		// display error if user submitted and authentication failed
		if ($this->request->is('post') && !$result->isValid()) {
			switch ($result->getStatus()) {
				case 'FAILURE_CREDENTIALS_MISSING':
					$this->Flash->error(__('Por favor, informe seu e-mail e sua senha.'));
					break;
				
				default:
					$this->Flash->error(__('E-mail ou senha inválidos.'));
					break;
			}
		}

		if ($this->request->getQuery('redirect') && $this->request->is('get')) {
			$this->Flash->error(__('Você precisa efetuar seu login para continuar.'));
		}

		$data = $this->request->getData();
		unset($data['senha']);

		$this->request = $this->request->withParsedBody($data);
	}

	/**
	 * Logout and redirect to another view
	 *
	 * @return \Cake\Http\Response|null
	 * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
	 * @throws \Cake\Http\Exception\NotFoundException When the view file could not
	 *   be found
	 * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
	 */
	public function logout() {
		$this->Authentication->logout();
    	return $this->redirect(['controller' => 'usuarios', 'action' => 'login']);
	}
}
