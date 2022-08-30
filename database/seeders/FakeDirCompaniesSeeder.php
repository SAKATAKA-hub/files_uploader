<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeDirCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # フェイカー
        $faker = \Faker\Factory::create('ja_JP');

        for ($i=0; $i < 3; $i++) {
            # フォルダデータの作成
            $dir_company = new \App\Models\DirCompany([
                'name'    => $faker->company,
                'manager' => $faker->name,
                'comment' => $faker->realText(100),
                'auth_key' => \Illuminate\Support\Str::random(40),
            ]);
            $dir_company->save();

            for ($fi=0; $fi < 5; $fi++) {
                # ファイルデータの作成
                $file = new \App\Models\File([
                    'dir_company_id' => $dir_company->id,
                    'name'     => '企業説明('.($fi+1).')',
                    'path'     => 'site/file/sampl.pdf',
                    'size'    => '1910320',
                    'auth_key' => \Illuminate\Support\Str::random(40),
                ]);
                $file->save();
            }
        }


    }
}
