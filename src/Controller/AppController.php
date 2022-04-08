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

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Cookie\CookieCollection;
use Cake\Database\TypeFactory;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * e.g. `$this->loadComponent('FormProtection');`
	 *
	 * @return void
	 */
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');

		/*
		 * Enable the following component for recommended CakePHP form protection settings.
		 * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
		 */
		$this->loadComponent('FormProtection');

		$this->loadComponent('Authentication.Authentication');
	}

	public function beforeFilter(EventInterface $event) { //funciona em todas as actions
		
		$this->loadModel('Paginas');
		$pagina = $this->Paginas->find('all')
			->where([
				'Paginas.controladora' => $this->name,
				'Paginas.acao' => $this->request->getParam('action'),
			])
			->first();

		$this->loadModel('Conteudos');

		if ($this->request->getParam('prefix') && $this->request->getParam('prefix') == 'Manager') {
			$this->viewBuilder()->setLayout('admin'); //carregar view admin no manager

			$conteudos = $this->Conteudos->find('all')
				->where([
					'Conteudos.controladora' => $this->name,
					'Conteudos.acao' => $this->request->getParam('action'),
				])
				->contain([
					'Parametros',
				])
				->toArray();

			$this->set([
				'pagina' => $pagina,
			]);
		}
		else {
			$this->Authentication->allowUnauthenticated([$this->request->getParam('action')]);

			if ($pagina) {
				list($width, $height, $type, $attr) = getimagesize(WWW_ROOT . 'content' . DS . 'pages' . DS . $pagina->imagem);

				$pagina->imagem = [
					'endereco' => '/content/pages/' . $pagina->imagem,
					'tipo' => image_type_to_mime_type($type),
					'largura' => $width,
					'altura' => $height,
				];

				$this->set([
					'pagina' => $pagina,
				]);
			}

			$conteudos = $this->Conteudos->find('all')
				->where([
					'Conteudos.controladora' => $this->name,
					'Conteudos.acao' => $this->request->getParam('action'),
				])
				->toArray();
		}

		$notifyCookie = $this->request->getCookie('notify-cookies');

		$this->set([
			'conteudos' => $conteudos,
			'notifyCookie' => $notifyCookie,
		]);

		// Define como é o formato de datas recebidos na requisições dos formulários
		TypeFactory::build('date')->useLocaleParser()->setLocaleFormat('dd/MM/yyyy');
		TypeFactory::build('datetime')->useLocaleParser()->setLocaleFormat('dd/MM/yyyy hh:mm');
	}
}