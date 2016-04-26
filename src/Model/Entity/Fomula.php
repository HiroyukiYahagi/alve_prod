<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fomula Entity.
 *
 * @property int $id
 * @property int $company_id
 * @property \App\Model\Entity\Company $company
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property \Cake\I18n\Time $fomula_start
 * @property \Cake\I18n\Time $fomula_end
 * @property int $completed
 * @property \App\Model\Entity\FomulaItem[] $fomula_items
 */
class Fomula extends Entity
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
