<?php
namespace App\Model\Table;

use App\Model\Entity\TypeHeadRelation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeHeadRelations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Types
 * @property \Cake\ORM\Association\BelongsTo $EvaluationHeads
 */
class TypeHeadRelationsTable extends Table
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

        $this->table('type_head_relations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Types', [
            'foreignKey' => 'type_id'
        ]);
        $this->belongsTo('EvaluationHeads', [
            'foreignKey' => 'evaluation_head_id'
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
        $rules->add($rules->existsIn(['type_id'], 'Types'));
        $rules->add($rules->existsIn(['evaluation_head_id'], 'EvaluationHeads'));
        return $rules;
    }
}
