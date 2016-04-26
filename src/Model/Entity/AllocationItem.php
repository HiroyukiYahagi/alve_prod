<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AllocationItem Entity.
 *
 * @property int $id
 * @property int $point
 * @property string $text
 * @property int $range_max
 * @property int $range_min
 * @property int $allocation_id
 * @property \App\Model\Entity\Allocation $allocation
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 */
class AllocationItem extends Entity
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
}
