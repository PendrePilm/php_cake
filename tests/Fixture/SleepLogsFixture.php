<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SleepLogsFixture
 */
class SleepLogsFixture extends TestFixture
{
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
                'user_id' => 1,
                'date' => '2024-12-09',
                'bedtime' => '21:47:10',
                'wake_time' => '21:47:10',
                'naps' => 'Lorem ipsum dolor sit amet',
                'wake_score' => 1,
                'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'sport_done' => 1,
                'created' => '2024-12-09 21:47:10',
                'modified' => '2024-12-09 21:47:10',
            ],
        ];
        parent::init();
    }
}
