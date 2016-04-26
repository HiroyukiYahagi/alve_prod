<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Unit Entity.
 *
 * @property int $id
 * @property string $category
 * @property string $name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property \App\Model\Entity\EvaluationItem[] $evaluation_items
 * @property \App\Model\Entity\FomulaItem[] $fomula_items
 */
class Unit extends Entity
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
