<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DataPenduduk;
use App\Models\DetailDataPenduduk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PermissionTableSeeder::class
        ]);

    
        for($i = 0; $i < 15; $i++){
            DataPenduduk::create([
                'no_kk' => time().$i,
                'kode_rt' => '001',
                'kepala_keluarga' => 'Test'.$i,
                'alamat' => 'Jl. Merdeka No. 2',
                'kode_pos' => '67890',
                'kecamatan' => 'Cikarang Utara',
                'kab_kota' => 'Bekasi',
                'provinsi' => 'Jawa Barat',
            ]);


            DetailDataPenduduk::create([
                'no_kk' => time().$i,
                'nama_lengkap' => 'Anggota'.$i,
                'nik' => time().$i,
                'jenis_kelamin' =>(rand(0,1) == 0) ? "Laki-Laki" : "Perempuan",
                'tempat_lahir' =>'Yogyakarta'.$i,
                'tanggal_lahir' =>date('Y-m-d'),
                'agama' => 'Kristen Protestan',
                'pendidikan' => 'S1',
                'jenis_perkerjaan' => 'PNS',
                'golongan_darah' => 'O',
                'status_perkawinan' => 'Belum Menikah',
                'tanggal_perkawinan' => (rand(0,1) == 0) ? date('Y-m-d') : null,
                'status_hdk' => null,
                'kewarganegaraan' => 'Indonesia',
                'dokumen_imigrasi' => null,
                'nama_orang_tua' => 'test'.$i,
                
            ]);
        }





      
    }
}
