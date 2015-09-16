<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => true,
    ];

    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
}