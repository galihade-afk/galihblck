<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'email'     => 'imam.setiawan@gmail.com',
                'password'  => bcrypt('imam'),
                'name'      => 'imam setiawan',
                'phone'     => '089506229150',
                'img'       => 'user.png',
                'address'   => 'Dsn. Bakanjati Ds. Pancawati Rt 001/003 Kec. Klari Kab. Karawang - Jawa Barat (41371)'
            ]
        ];

        foreach ($data as $row)
        {
            User::create($row);
        }
    }
}
