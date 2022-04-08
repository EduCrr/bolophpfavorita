<?php

namespace App\View\Cell;

use Cake\View\Cell;

class FormContentCell extends Cell
{
	public function display($conteudo, $toolbar = null, $full = false)
	{
		$this->loadModel('Conteudos');

		$conteudo = $this->Conteudos->find('all')
			->where([
				'Conteudos.id' => $conteudo->id,
				'Conteudos.acao' => $this->request->getParam('action'),
			])
			->contain([
				'Parametros'
			])
			->first();

		$this->set([
			'conteudo' => $conteudo,
			'toolbar' => $toolbar,
			'full' => $full,
		]);
	}
}