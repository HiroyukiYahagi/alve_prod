<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Allocation Entity.
 *
 * @property int $id
 * @property string $allocation_name
 * @property int $allocation_type
 * @property string $allocation_unit
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property \App\Model\Entity\AllocationItem[] $allocation_items
 * @property \App\Model\Entity\EvaluationHead[] $evaluation_heads
 * @property \App\Model\Entity\FomulaHead[] $fomula_heads
 */
class Allocation extends Entity
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
