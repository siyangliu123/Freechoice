<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SaleRecord Model
 *
 * @method \App\Model\Entity\SaleRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\SaleRecord newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SaleRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SaleRecord|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SaleRecord saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SaleRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SaleRecord[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SaleRecord findOrCreate($search, callable $callback = null, $options = [])
 */
class SaleRecordTable extends Table
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

        $this->setTable('sale_record');
        $this->setDisplayField('record_id');
        $this->setPrimaryKey('record_id');

        $this->belongsTo('cigarette', [
            'foreignKey' => 'record_item',
            'joinType' => 'INNER'
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
            ->integer('record_id')
            ->allowEmptyString('record_id', 'create')
            ->add('record_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('record_date')
            ->maxLength('record_date', 255)
            ->requirePresence('record_date', 'create')
            ->allowEmptyString('record_date', false);

        $validator
            ->integer('record_item')
            ->requirePresence('record_item', 'create')
            ->allowEmptyString('record_item', false);

        $validator
            ->integer('record_sold_quantity')
            ->requirePresence('record_sold_quantity', 'create')
            ->allowEmptyString('record_sold_quantity', false);

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
        $rules->add($rules->isUnique(['record_id']));
        $rules->add($rules->existsIn(['Cig_id'], 'Cigarette'));


        return $rules;
    }
}
