<?php

use Illuminate\Database\Seeder;

class IdeasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ideas')->insert([
            [
                'name' => "reconnecting",
                'description' => "aplikasi mobile yang membantu kaum urban dalam mempermudah kegiatan networking dan silaturahim mereka dengan sistem manajemen kontak, pesan, dan penjadwalan silaturahim otomatis",
                'owner' => 'intern@badr.com',
                'like' => 0,
                'skip' => 0,
                'viewed' => 0,
            ],
            [
                'name' => "SakuNelayan",
                'description' => "platform pasar online yang mempertemukan pembeli dengan nelayan dalam bentuk permodalan (jual beli salam)",
                'owner' => 'intern@badr.com',
                'like' => 0,
                'skip' => 0,
                'viewed' => 0,
            ],
            [
                'name' => "youngspeak",
                'description' => "aplikasi mobile yang menjadi channel kaum muda inspiratif untuk sharing pemikiran/ide/ilmu dalam bentuk video dan suara, sehingga bisa mendapatkan audience dengan konsep social media",
                'owner' => 'intern@badr.com',
                'like' => 0,
                'skip' => 0,
                'viewed' => 0,
            ],
        ]);
    }
}
