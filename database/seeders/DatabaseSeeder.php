<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ListModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dataBrand = ["Bosch", "Ryu", "Tekiro", "Livi"];
        $dataProduk = ["Tipe 1", "Tipe 2", "Tipe 3", "Tipe 4"];

        for ($i = 0; $i < 100; $i++) {
            $randomBrand = $dataBrand[array_rand($dataBrand)];
            $randomProduk = $dataProduk[array_rand($dataProduk)];

            ListModel::create([
                'nama_produk' => $randomBrand . " " . $randomProduk,
                'jenis_produk' => $randomBrand,
                'is_active'=> 1,
                'harga' => mt_rand(10000, 100000),
            ]);
        }

    }
}
