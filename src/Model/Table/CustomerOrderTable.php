<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerOrder Model
 *
 * @method \App\Model\Entity\CustomerOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomerOrder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CustomerOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerOrder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerOrder findOrCreate($search, callable $callback = null, $options = [])
 */
class CustomerOrderTable extends Table
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

        $this->setTable('customer_order');
        $this->setDisplayField('customer_order_id');
        $this->setPrimaryKey('customer_order_id');
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
            ->integer('customer_order_id')
            ->allowEmptyString('customer_order_id', 'create')
            ->add('customer_order_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('customer_name')
            ->maxLength('customer_name', 50)
            ->requirePresence('customer_name', 'create')
            ->allowEmptyString('customer_name', false);

        $validator
            ->scalar('customer_contact')
            ->maxLength('customer_contact', 50)
            ->requirePresence('customer_contact', 'create')
            ->allowEmptyString('customer_contact', false);

        $validator
            ->scalar('customer_order_detail')
            ->maxLength('customer_order_detail', 500)
            ->requirePresence('customer_order_detail', 'create')
            ->allowEmptyString('customer_order_detail', false);

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
        $rules->add($rules->isUnique(['customer_order_id']));

        return $rules;
    }
}
