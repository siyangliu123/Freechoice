<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderCigarette Model
 *
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 * @property |\Cake\ORM\Association\BelongsTo $Cigarettes
 *
 * @method \App\Model\Entity\OrderCigarette get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderCigarette newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderCigarette[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderCigarette|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderCigarette saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderCigarette patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderCigarette[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderCigarette findOrCreate($search, callable $callback = null, $options = [])
 */
class OrderCigaretteTable extends Table
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

        $this->setTable('order_cigarette');
        $this->setDisplayField('order_cigarette_id');
        $this->setPrimaryKey('order_cigarette_id');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cigarette', [
            'foreignKey' => 'cigarette_id',
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
            ->integer('order_cigarette_id')
            ->allowEmptyString('order_cigarette_id', 'create');

        $validator
            ->numeric('packet_price')
            ->requirePresence('packet_price', 'create')
            ->allowEmptyString('packet_price', false);

        $validator
            ->integer('packet_quantity')
            ->requirePresence('packet_quantity', 'create')
            ->allowEmptyString('packet_quantity', false);

        $validator
            ->numeric('carton_price')
            ->requirePresence('carton_price', 'create')
            ->allowEmptyString('carton_price', false);

        $validator
            ->integer('carton_quantity')
            ->requirePresence('carton_quantity', 'create')
            ->allowEmptyString('carton_quantity', false);

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['cigarette_id'], 'Cigarette'));

        return $rules;
    }
}
