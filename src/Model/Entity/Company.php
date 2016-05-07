<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;

/**
 * Company Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property int $deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $is_admin
 * @property string $company_name
 * @property string $url
 * @property string $tel
 * @property string $email
 * @property \App\Model\Entity\Fomula[] $fomulas
 * @property \App\Model\Entity\Product[] $products
 */
class Company extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
