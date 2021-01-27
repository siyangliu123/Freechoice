<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockRecord Model
 *
 * @method \App\Model\Entity\StockRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockRecord newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockRecord|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockRecord saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockRecord[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockRecord findOrCreate($search, callable $callback = null, $options = [])
 */
class StockRecordTable extends Table
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

        $this->setTable('stock_record');
        $this->setDisplayField('stock_record_id');
        $this->setPrimaryKey('stock_record_id');
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
            ->integer('stock_record_id')
            ->allowEmptyString('stock_record_id', 'create')
            ->add('stock_record_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('stock_record_item')
            ->maxLength('stock_record_item', 255)
            ->requirePresence('stock_record_item', 'create')
            ->allowEmptyString('stock_record_item', false);

        $validator
            ->integer('stock_location')
            ->requirePresence('stock_location', 'create')
            ->allowEmptyString('stock_location', false);

        $validator
            ->integer('stock_record_quantity')
            ->requirePresence('stock_record_quantity', 'create')
            ->allowEmptyString('stock_record_quantity', false);

        $validator
            ->scalar('stock_record_date')
            ->maxLength('stock_record_date', 255)
            ->requirePresence('stock_record_date', 'create')
            ->allowEmptyString('stock_record_date', false);

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
        $rules->add($rules->isUnique(['stock_record_id']));

        return $rules;
    }
}
