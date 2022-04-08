<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Imagem extends Entity {

	// Gera conjunto de todos os campos exceto o com a chave primária.
	protected $_accessible = [
		'*' => true,
		'id' => false,
	];
}