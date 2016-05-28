<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;

/**
 * Evaluation Entity.
 *
 * @property int $id
 * @property int $product_id
 * @property int $compared_product_id
 * @property \App\Model\Entity\Product $product
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $deleted
 * @property string $update_comment
 * @property int $completed
 * @property \App\Model\Entity\EvaluationItem[] $evaluation_items
 */
class Evaluation extends Entity
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


    protected function _setComparedSalesDate($value){
        if($value == null)
            return null;
        if($value != null && is_string($value)){
            $value = new Time($value, 'Asia/Tokyo');
            $value->hour = 0;
            $value->minute = 0;
        }
        return $value;
    }

    public function set($property, $value = null, array $options = [])
    {
        if(is_string($value)){
            $value = htmlspecialchars($value, ENT_QUOTES);
        }
        parent::set($property, $value, $options);
    }
}
