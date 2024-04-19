<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartiesFixture
 */
class PartiesFixture extends TestFixture
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
                'nik' => 'Lorem ipsum do',
                'name' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsu',
                'role' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
