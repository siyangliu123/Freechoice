<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Announcement Model
 *
 * @method \App\Model\Entity\Announcement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Announcement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Announcement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Announcement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Announcement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Announcement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Announcement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Announcement findOrCreate($search, callable $callback = null, $options = [])
 */
class AnnouncementTable extends Table
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

        $this->setTable('announcement');
        $this->setDisplayField('announcement_id');
        $this->setPrimaryKey('announcement_id');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'announcement_file' => [
                'fields' => [
                    'dir' => 'announcement_file_dir', // defaults to `dir`
                ],
            ],
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
            ->integer('announcement_id')
            ->allowEmptyString('announcement_id', 'create');

        $validator
            ->scalar('announcement_title')
            ->maxLength('announcement_title', 255)
            ->requirePresence('announcement_title', 'create')
            ->allowEmptyString('announcement_title', false);

        $validator
            ->scalar('announcement_content')
            ->maxLength('announcement_content', 255)
            ->requirePresence('announcement_content', 'create')
            ->allowEmptyString('announcement_content', false);

        $validator
            ->allowEmptyFile('announcement_file');

        $validator
            ->allowEmptyFile('announcement_file_dir');
            
        $validator
            ->dateTime('announcement_date')
            ->allowEmptyDateTime('announcement_date');

        return $validator;
    }
}
