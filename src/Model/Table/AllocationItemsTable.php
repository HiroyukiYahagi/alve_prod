<?php
namespace App\Model\Table;

use App\Model\Entity\AllocationItem;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AllocationItems Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Allocations
 */
class AllocationItemsTable extends Table
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

        $this->table('allocation_items');
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
            ->integer('point')
            ->allowEmpty('point');

        $validator
            ->allowEmpty('text');

        $validator
            ->integer('range_max')
            ->allowEmpty('range_max');

        $validator
            ->integer('range_min')
            ->allowEmpty('range_min');

        $validator
            ->integer('deleted')
            ->allowEmpty('deleted');

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
