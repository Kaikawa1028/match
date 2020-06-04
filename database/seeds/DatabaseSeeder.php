<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $user_name = [
        'kei',
        'ゆうと',
        'taiki',
        'ryo',
        '元気',
        'コースケ',
        '圭太',
        'you',
        '星野',
        'リョタ',
        '匠',
        'taku',
        'hena',
        'nanami',
        '草津',
        'よし',
        '龍',
        'gakuto',
        'syota',
        '平山',
        '健一',
        'yone',
        'waka',
        'ゆうな',
        'min',
        '美咲',
        'hana',
        'suzu',
        '良子',
        'さく',
        'まり',
        '優子',
        'hiromi',
        'hina',
        'yomi',
        '真奈',
        '舞',
        'マリカ',
        'マリク',
        '田中',
        'yuko',
        'syo',
        'marimo',
        'sakura',
        'saku',
        'mine',
    ];

    private $img_url = [
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/3/40e84e95.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/4/42905757_1946147315443146_8509928890392442925_n.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/5/a0001508_main.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/6/aru.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/7/cf8ad1fe-e91e-4d87-994d-daa071aa4cf5.png',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/8/chinese+bus+conductor.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/9/Cj3FiF2sBboVeCKS.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/10/HvA9NTNJmq8JCRxn.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/11/ikemen3.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/12/8692aeca795b8d34d9613d19ba4bcd.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/13/images.jpeg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/14/man1-600x400.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/15/shutterstock_105312263.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/16/shutterstock_771863392.jpg',
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/23/e9c4adcad25746262bcb42e68fbbd29a-1024x683.jpeg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/24/1-2_28123514207215_xxlarge.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/25/61yRukfzxcL.CR157%2C0%2C513%2C513.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/26/105689.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/27/5588814_full_b81e3e5b-8baa-46ed-977e-447b2185dc07_.jpeg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/28/94245676_229442788293542_5081275938208956573_n.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/29/13170389601f8.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/30/1537689884340+(1).jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/31/a0002582_main.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/32/a0003276_parts_5cd9332a758ae.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/33/DCD6E137-5878-4942-B514-3B2A4AA859D5.jpeg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/34/e4533954.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/35/fokeofkeofe-640x640.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/36/images.jpeg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/37/o0800051314246381568.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/38/shutterstock_327540476-e1544534212683.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/39/vietnam4.jpg',
        'https://matching-kou.s3-ap-northeast-1.amazonaws.com/40/%E7%BE%8E%E4%BA%BA%E3%82%BF%E3%82%A4%E4%BA%BA%E3%81%AE%E5%A5%B3%E6%80%A7.jpg',
        null,
        null,
        null,
        null,
        null
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(UserProfileTableSeeder::class);

        for($i = 3; $i < 23; $i++) {
            factory(App\User::class, 1)->create(['id' => $i, 'sex' => 1, 'name' => $this->user_name[$i - 3]])->each(function ($user) use($i){
                factory(App\Model\UserProfile::class, 1)->create(['user_id' => $user->id, 'user_name' => $this->user_name[$i - 3], 'img_url' => $this->img_url[$i - 3]]);
            });
        }

        for($i = 23; $i < 43; $i++) {
            factory(App\User::class, 1)->create(['id' => $i, 'sex' => 0, 'name' => $this->user_name[$i - 1]])->each(function ($user) use($i){
                factory(App\Model\UserProfile::class, 1)->create(['user_id' => $user->id,'user_name' => $this->user_name[$i -1], 'img_url' => $this->img_url[$i - 1]]);
            });
        }

        $this->call(RoomsTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
    }
}
