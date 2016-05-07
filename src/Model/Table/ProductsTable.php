<?php
namespace App\Model\Table;

use App\Model\Entity\Product;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Types
 * @property \Cake\ORM\Association\HasMany $Evaluations
 */
class ProductsTable extends Table
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

        $this->table('products');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id'
        ]);
        $this->belongsTo('Types', [
            'foreignKey' => 'type_id'
        ]);
        $this->hasMany('Evaluations', [
            'foreignKey' => 'product_id'
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
            ->allowEmpty('product_name');

        $validator
            ->allowEmpty('model_number');

        $validator
            ->allowEmpty('operator_name');

        $validator
            ->integer('deleted')
            ->allowEmpty('deleted');

        $validator
            ->allowEmpty('product_comment');

        $validator
            ->allowEmpty('product_info_url');

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
        $rules->add($rules->existsIn(['type_id'], 'Types'));
        return $rules;
    }

    public function findByConditions($condition, $options)
    {
        $query = $this->find()->contain(['Types', 'Companies'])->where(['published' => 1]);

        if($condition!=null){
            $query->where(['product_name LIKE' => '%'.$condition.'%' ]);
        }
        if($options!=null){
            $query->where(['Types.id IN' => $options ]);
        }
        
        return $query->all()->toArray();
    }
}
