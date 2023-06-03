<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DataPenduduk;
use App\Models\DataRT;
use App\Models\DetailDataPenduduk;
use App\Models\Sejarah;
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

        DataRT::create([
            'kode_rt' => (rand(0,1) == 0) ? "RT 01" : "RT 02",
            'nama_rt' => (rand(0,1) == 0) ? "RT 01" : "RT 02",
            'keterangan' => 'Test ini keterangan'
        ]);

        DataRT::create([
            'kode_rt' => (rand(0,1) == 0) ? "RT 01" : "RT 02",
            'nama_rt' => (rand(0,1) == 0) ? "RT 01" : "RT 02",
            'keterangan' => 'Test ini keterangan'
        ]);


        Sejarah::create([
            'sejarah' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.'
        ]);



      
    }
}
