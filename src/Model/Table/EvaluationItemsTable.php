<?php
namespace App\Model\Table;

use App\Model\Entity\EvaluationItem;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EvaluationItems Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Evaluations
 * @property \Cake\ORM\Association\BelongsTo $EvaluationHeads
 * @property \Cake\ORM\Association\BelongsTo $Units
 */
class EvaluationItemsTable extends Table
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

        $this->table('evaluation_items');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Evaluations', [
            'foreignKey' => 'evaluation_id'
        ]);
        $this->belongsTo('EvaluationHeads', [
            'foreignKey' => 'head_id'
        ]);
        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id'
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
            ->integer('deleted')
            ->allowEmpty('deleted');

        $validator
            ->allowEmpty('value');

        $validator
            ->allowEmpty('compared_value');

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
        $rules->add($rules->existsIn(['evaluation_id'], 'Evaluations'));
        $rules->add($rules->existsIn(['head_id'], 'EvaluationHeads'));
        $rules->add($rules->existsIn(['unit_id'], 'Units'));
        return $rules;
    }
}
