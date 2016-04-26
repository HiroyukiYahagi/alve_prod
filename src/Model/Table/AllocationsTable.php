<?php
namespace App\Model\Table;

use App\Model\Entity\Allocation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Allocations Model
 *
 * @property \Cake\ORM\Association\HasMany $AllocationItems
 * @property \Cake\ORM\Association\HasMany $EvaluationHeads
 * @property \Cake\ORM\Association\HasMany $FomulaHeads
 */
class AllocationsTable extends Table
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

        $this->table('allocations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AllocationItems', [
            'foreignKey' => 'allocation_id'
        ]);
        $this->hasMany('EvaluationHeads', [
            'foreignKey' => 'allocation_id'
        ]);
        $this->hasMany('FomulaHeads', [
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
            ->allowEmpty('allocation_name');

        $validator
            ->integer('allocation_type')
            ->allowEmpty('allocation_type');

        $validator
            ->allowEmpty('allocation_unit');

        $validator
            ->integer('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }
}
