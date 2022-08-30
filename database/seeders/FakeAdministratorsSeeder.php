<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
/*
| =============================================
|  管理者 (Administrator) フェイクデータ
| =============================================
*/

class FakeAdministratorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # 保存データ一覧
        $datalist = [
            [
                'user' => [
                    'name' => '酒井貴弘',
                    'email' => 't.sakai@next-arrow.co.jp',
                    'password' => Hash::make('password'),
                ],
                'admin' => [
                    'name' => '酒井貴弘',
                    'master' => 1,
                    'get_mail' => 1,
                ],
            ],
            [
                'user' => [
                    'name' => 'Next Arrow',
                    'email' => 'nextarrow.line@gmail.com',
                    'password' => Hash::make('password'),
                ],
                'admin' => [
                    'name' => 'Next Arrow',
                    'master' => 1,
                    'get_mail' => 1,
                ],
            ],

        ];


        # 従業員情報の保存
        foreach ($datalist as $data)
        {
            # userデータの保存
            $user = new \App\Models\User($data['user']);
            $user->save();


            # administratorデータの保存
            $administrator_data = $data['admin'];
            $administrator_data['user_id'] = $user->id;

            $administrator = new \App\Models\Administrator($administrator_data);
            $administrator->save();
        }
    }
}
