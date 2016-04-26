<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FomulaHead Entity.
 *
 * @property int $id
 * @property string $large_type
 * @property string $medium_type
 * @property string $small_type
 * @property string $item_description
 * @property string $item_criteria
 * @property int $allocation_id
 * @property \App\Model\Entity\Allocation $allocation
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property int $required
 * @property string $unit_category
 * @property string $options
 */
class FomulaHead extends Entity
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
