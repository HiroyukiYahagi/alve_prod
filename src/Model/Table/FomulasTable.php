<?php
namespace App\Model\Table;

use App\Model\Entity\Fomula;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * Fomulas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\HasMany $FomulaItems
 */
class FomulasTable extends Table
{
    use SoftDeleteTrait;
    protected $softDeleteField = 'deleted';

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('fomulas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('FomulaItems', [
            'foreignKey' => 'fomula_id'
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
            ->dateTime('fomula_start')
            ->allowEmpty('fomula_start');

        $validator
            ->dateTime('fomula_end')
            ->allowEmpty('fomula_end');

        $validator
            ->integer('completed')
            ->allowEmpty('completed');

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        return $rules;
    }
}
