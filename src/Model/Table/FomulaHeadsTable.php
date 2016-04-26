<?php
namespace App\Model\Table;

use App\Model\Entity\FomulaHead;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FomulaHeads Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Allocations
 */
class FomulaHeadsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('fomula_heads');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Allocations', [
            'foreignKey' => 'allocation_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('large_type');

        $validator
            ->allowEmpty('medium_type');

        $validator
            ->allowEmpty('small_type');

        $validator
            ->allowEmpty('item_description');

        $validator
            ->allowEmpty('item_criteria');

        $validator
            ->integer('deleted')
            ->allowEmpty('deleted');

        $validator
            ->integer('required')
            ->allowEmpty('required');

        $validator
            ->allowEmpty('unit_category');

        $validator
            ->allowEmpty('options');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['allocation_id'], 'Allocations'));
        return $rules;
    }
}
