<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InvoiceCigarette Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Invoices
 *
 * @method \App\Model\Entity\InvoiceCigarette get($primaryKey, $options = [])
 * @method \App\Model\Entity\InvoiceCigarette newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InvoiceCigarette[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceCigarette|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoiceCigarette saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoiceCigarette patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceCigarette[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceCigarette findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoiceCigaretteTable extends Table
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

        $this->setTable('invoice_cigarette');
        $this->setDisplayField('invoice_cigarette_id');
        $this->setPrimaryKey('invoice_cigarette_id');

        $this->belongsTo('Invoice', [
            'foreignKey' => 'invoice_id',
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
            ->integer('invoice_cigarette_id')
            ->allowEmptyString('invoice_cigarette_id', 'create');

        $validator
            ->scalar('cigarette_brand')
            ->maxLength('cigarette_brand', 255)
            ->requirePresence('cigarette_brand', 'create')
            ->allowEmptyString('cigarette_brand', false);

        $validator
            ->scalar('cigarette_size')
            ->maxLength('cigarette_size', 255)
            ->requirePresence('cigarette_size', 'create')
            ->allowEmptyString('cigarette_size', false);

        $validator
            ->scalar('cigarette_flavor')
            ->maxLength('cigarette_flavor', 255)
            ->requirePresence('cigarette_flavor', 'create')
            ->allowEmptyString('cigarette_flavor', false);

        $validator
            ->numeric('packet_price')
            ->requirePresence('packet_price', 'create')
            ->allowEmptyString('packet_price', false);

        $validator
            ->integer('packet_from_shop')
            ->requirePresence('packet_from_shop', 'create')
            ->allowEmptyString('packet_from_shop', false);

        $validator
            ->integer('packet_from_warehouse')
            ->requirePresence('packet_from_warehouse', 'create')
            ->allowEmptyString('packet_from_warehouse', false);

        $validator
            ->numeric('carton_price')
            ->requirePresence('carton_price', 'create')
            ->allowEmptyString('carton_price', false);

        $validator
            ->integer('carton_from_shop')
            ->requirePresence('carton_from_shop', 'create')
            ->allowEmptyString('carton_from_shop', false);

        $validator
            ->integer('carton_from_warehouse')
            ->requirePresence('carton_from_warehouse', 'create')
            ->allowEmptyString('carton_from_warehouse', false);

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
        $rules->add($rules->existsIn(['invoice_id'], 'Invoice'));

        return $rules;
    }
}
