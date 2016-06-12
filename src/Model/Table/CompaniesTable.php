<?php
namespace App\Model\Table;

use App\Model\Entity\Company;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Datasource\EntityInterface;

use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * Companies Model
 *
 * @property \Cake\ORM\Association\HasMany $Fomulas
 * @property \Cake\ORM\Association\HasMany $Products
 */
class CompaniesTable extends Table
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

        $this->table('companies');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fomulas', [
            'foreignKey' => 'company_id'
        ]);
        
        $this->hasMany('Products', [
            'foreignKey' => 'company_id'
        ]);

        $this->hasMany('LoginHistories', [
            'foreignKey' => 'company_id'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('password');

        $validator
            ->integer('deleted')
            ->allowEmpty('deleted');

        $validator
            ->integer('is_admin')
            ->allowEmpty('is_admin');

        $validator
            ->allowEmpty('company_name');

        $validator
            ->allowEmpty('url');

        $validator
            ->allowEmpty('tel');

        $validator
            ->email('email')
            ->allowEmpty('email');

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
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

}
