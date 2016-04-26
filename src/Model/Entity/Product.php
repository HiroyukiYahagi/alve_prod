<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity.
 *
 * @property int $id
 * @property int $company_id
 * @property \App\Model\Entity\Company $company
 * @property int $type_id
 * @property \App\Model\Entity\Type $type
 * @property string $product_name
 * @property string $model_number
 * @property string $operator_name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property string $product_comment
 * @property string $product_info_url
 * @property \App\Model\Entity\Evaluation[] $evaluations
 */
class Product extends Entity
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
