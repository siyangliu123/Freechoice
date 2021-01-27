<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CigaretteFlavorFixture
 */
class CigaretteFlavorFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cigarette_flavor';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Cig_flavor_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Cig_priceid' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Cig_flavor' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Cig_flavor_id'], 'length' => []],
            'cigarette_flavor_Cig_flavor_id_uindex' => ['type' => 'unique', 'columns' => ['Cig_flavor_id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'Cig_flavor_id' => 1,
                'Cig_priceid' => 1,
                'Cig_flavor' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
