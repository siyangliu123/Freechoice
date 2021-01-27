<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cigarette Model
 *
 * @method \App\Model\Entity\Cigarette get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cigarette newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cigarette[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cigarette|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cigarette saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cigarette patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cigarette[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cigarette findOrCreate($search, callable $callback = null, $options = [])
 */
class CigaretteTable extends Table
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

        $this->setTable('cigarette');
        $this->setDisplayField('Cig_id');
        $this->setPrimaryKey('Cig_id');
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
            ->integer('Cig_id')
            ->allowEmptyString('Cig_id', 'create');

        $validator
            ->scalar('Cig_brand')
            ->maxLength('Cig_brand', 50)
            ->requirePresence('Cig_brand', 'create')
            ->allowEmptyString('Cig_brand', false);

        $validator
            ->scalar('Cig_flavor')
            ->maxLength('Cig_flavor', 50)
            ->requirePresence('Cig_flavor', 'create')
            ->allowEmptyString('Cig_flavor', false);

        $validator
            ->scalar('Cig_size')
            ->maxLength('Cig_size', 50)
            ->requirePresence('Cig_size', 'create')
            ->allowEmptyString('Cig_size', false);

        $validator
            ->decimal('Cig_packet_price')
            ->requirePresence('Cig_packet_price', 'create')
            ->allowEmptyString('Cig_packet_price', false);

        $validator
            ->decimal('Cig_carton_price')
            ->requirePresence('Cig_carton_price', 'create')
            ->allowEmptyString('Cig_carton_price', false);

        $validator
            ->scalar('Cig_company')
            ->maxLength('Cig_company', 50)
            ->requirePresence('Cig_company', 'create')
            ->allowEmptyString('Cig_company', false);

        $validator
            ->integer('Cig_warehouse_stock')
            ->requirePresence('Cig_warehouse_stock', 'create')
            ->allowEmptyString('Cig_warehouse_stock', false);

        $validator
            ->integer('Cig_shop_stock')
            ->requirePresence('Cig_shop_stock', 'create')
            ->allowEmptyString('Cig_shop_stock', false);

        $validator
            ->scalar('Cig_packet_barcode')
            ->maxLength('Cig_packet_barcode', 255)
            ->allowEmptyString('Cig_packet_barcode');

        $validator
            ->scalar('Cig_carton_barcode')
            ->maxLength('Cig_carton_barcode', 255)
            ->allowEmptyString('Cig_carton_barcode');

        $validator
            ->integer('Cig_packet_in_carton')
            ->requirePresence('Cig_packet_in_carton', 'create')
            ->allowEmptyString('Cig_packet_in_carton', false);

        $validator
            ->decimal('Cig_retail_price')
            ->requirePresence('Cig_retail_price', 'create')
            ->allowEmptyString('Cig_retail_price', false);

        $validator
            ->integer('Cig_base_number')
            ->requirePresence('Cig_base_number', 'create')
            ->allowEmptyString('Cig_base_number', false);

        return $validator;
    }
}
