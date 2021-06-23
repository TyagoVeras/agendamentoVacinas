<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SchedulesFixture
 */
class SchedulesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'data' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'hora' => ['type' => 'time', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'vacinado' => ['type' => 'tinyinteger', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'display' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'observacao' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'person_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'dose_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'category_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'vaccine_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'place_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_schedules_people_idx' => ['type' => 'index', 'columns' => ['person_id'], 'length' => []],
            'fk_schedules_doses1_idx' => ['type' => 'index', 'columns' => ['dose_id'], 'length' => []],
            'fk_schedules_categories1_idx' => ['type' => 'index', 'columns' => ['category_id'], 'length' => []],
            'fk_schedules_vaccines1_idx' => ['type' => 'index', 'columns' => ['vaccine_id'], 'length' => []],
            'fk_schedules_places1_idx' => ['type' => 'index', 'columns' => ['place_id'], 'length' => []],
            'fk_schedules_users1_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_schedules_vaccines1' => ['type' => 'foreign', 'columns' => ['vaccine_id'], 'references' => ['vaccines', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_schedules_places1' => ['type' => 'foreign', 'columns' => ['place_id'], 'references' => ['places', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_schedules_people' => ['type' => 'foreign', 'columns' => ['person_id'], 'references' => ['people', 'id'], 'update' => 'cascade', 'delete' => 'setNull', 'length' => []],
            'fk_schedules_doses1' => ['type' => 'foreign', 'columns' => ['dose_id'], 'references' => ['doses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_schedules_categories1' => ['type' => 'foreign', 'columns' => ['category_id'], 'references' => ['categories', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'data' => '2021-06-20',
                'hora' => '23:17:05',
                'vacinado' => 1,
                'display' => 'Lorem ipsum dolor sit amet',
                'created' => '2021-06-20 23:17:05',
                'modified' => '2021-06-20 23:17:05',
                'observacao' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'person_id' => 1,
                'dose_id' => 1,
                'category_id' => 1,
                'vaccine_id' => 1,
                'place_id' => 1,
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
