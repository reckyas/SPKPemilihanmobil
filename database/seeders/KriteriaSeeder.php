<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Kriteria::insert([
        //     [
        //         'nama' => 'Tahun keluar',
        //         'bobot' => 0.10
        //     ],
        //     [
        //         'nama' => 'Harga',
        //         'bobot' => 0.25
        //     ],
        //     [
        //         'nama' => 'Model',
        //         'bobot' => 0.10
        //     ],
        //     [
        //         'nama' => 'Transmisi',
        //         'bobot' => 0.15
        //     ],
        //     [
        //         'nama' => 'Kapasitas mesin',
        //         'bobot' => 0.8
        //     ],
        //     [
        //         'nama' => 'Kapasitas penumpang',
        //         'bobot' => 0.10
        //     ],
        //     [
        //         'nama' => 'Konsumsi BBM',
        //         'bobot' => 0.12
        //     ],
        //     [
        //         'nama' => 'Ketersediaan Sparetpart',
        //         'bobot' => 0.5
        //     ]
        // ]);
        \App\Models\SubKriteria::insert([
            [
                'nama' => '<2000',
                'bobot' => 1,
                'kriteria_id' => 1
            ],
            [
                'nama' => '2000-2007',
                'bobot' => 2,
                'kriteria_id' => 1
            ],
            [
                'nama' => '2008-2013',
                'bobot' => 3,
                'kriteria_id' => 1
            ],
            [
                'nama' => '2014-2017',
                'bobot' => 1,
                'kriteria_id' => 4
            ],
            [
                'nama' => '>2018',
                'bobot' => 1,
                'kriteria_id' => 1
            ],
            [
                'nama' => '401000000>',
                'bobot' => 1,
                'kriteria_id' => 2
            ],
            [
                'nama' => '301000000-400000000>',
                'bobot' => 2,
                'kriteria_id' => 2
            ]
        ]);
    }
}
