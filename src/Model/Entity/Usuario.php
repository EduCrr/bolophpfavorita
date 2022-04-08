<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class Usuario extends Entity {

	// Gera conjunto de todos os campos exceto o com a chave primária.
	protected $_accessible = [
		'*' => true,
		'id' => false,
	];

	protected function _setSenha($password) {
		$hasher = new DefaultPasswordHasher();
		return $hasher->hash($password);
	}
}