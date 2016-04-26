<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FomulaItem Entity.
 *
 * @property int $id
 * @property int $fomula_id
 * @property \App\Model\Entity\Fomula $fomula
 * @property int $head_id
 * @property \App\Model\Entity\FomulaHead $fomula_head
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property string $value
 * @property int $unit_id
 * @property \App\Model\Entity\Unit $unit
 */
class FomulaItem extends Entity
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
