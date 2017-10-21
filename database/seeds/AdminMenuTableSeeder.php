<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Index',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Admin',
                'icon' => 'fa-tasks',
                'uri' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 2,
                'order' => 7,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 0,
                'order' => 19,
                'title' => '素材',
                'icon' => 'fa-puzzle-piece',
                'uri' => 'materials',
                'created_at' => '2017-09-22 09:25:34',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 8,
                'order' => 21,
                'title' => '创建',
                'icon' => 'fa-plus',
                'uri' => 'materials/create',
                'created_at' => '2017-09-22 09:37:00',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 8,
                'order' => 20,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'materials',
                'created_at' => '2017-09-22 09:37:59',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 0,
                'order' => 8,
                'title' => 'Helpers',
                'icon' => 'fa-gears',
                'uri' => '',
                'created_at' => '2017-09-22 09:55:06',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 11,
                'order' => 9,
                'title' => 'Scaffold',
                'icon' => 'fa-keyboard-o',
                'uri' => 'helpers/scaffold',
                'created_at' => '2017-09-22 09:55:06',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => 11,
                'order' => 10,
                'title' => 'Database terminal',
                'icon' => 'fa-database',
                'uri' => 'helpers/terminal/database',
                'created_at' => '2017-09-22 09:55:06',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            13 => 
            array (
                'id' => 14,
                'parent_id' => 11,
                'order' => 11,
                'title' => 'Laravel artisan',
                'icon' => 'fa-terminal',
                'uri' => 'helpers/terminal/artisan',
                'created_at' => '2017-09-22 09:55:06',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            14 => 
            array (
                'id' => 15,
                'parent_id' => 11,
                'order' => 12,
                'title' => 'Routes',
                'icon' => 'fa-list-alt',
                'uri' => 'helpers/routes',
                'created_at' => '2017-09-22 09:55:06',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            15 => 
            array (
                'id' => 16,
                'parent_id' => 0,
                'order' => 16,
                'title' => '素材分类',
                'icon' => 'fa-bars',
                'uri' => NULL,
                'created_at' => '2017-09-22 12:36:17',
                'updated_at' => '2017-09-23 07:33:43',
            ),
            16 => 
            array (
                'id' => 17,
                'parent_id' => 16,
                'order' => 17,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'materialTypes',
                'created_at' => '2017-09-22 12:37:26',
                'updated_at' => '2017-09-23 07:33:53',
            ),
            17 => 
            array (
                'id' => 18,
                'parent_id' => 16,
                'order' => 18,
                'title' => '创建',
                'icon' => 'fa-plus',
                'uri' => 'materialTypes/create',
                'created_at' => '2017-09-22 12:37:51',
                'updated_at' => '2017-09-23 07:33:59',
            ),
            18 => 
            array (
                'id' => 19,
                'parent_id' => 0,
                'order' => 13,
                'title' => '文字',
                'icon' => 'fa-file-text',
                'uri' => NULL,
                'created_at' => '2017-09-23 05:34:48',
                'updated_at' => '2017-09-23 05:38:36',
            ),
            19 => 
            array (
                'id' => 20,
                'parent_id' => 19,
                'order' => 14,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'words',
                'created_at' => '2017-09-23 05:35:16',
                'updated_at' => '2017-09-23 07:34:05',
            ),
            20 => 
            array (
                'id' => 21,
                'parent_id' => 19,
                'order' => 15,
                'title' => '创建',
                'icon' => 'fa-plus',
                'uri' => 'words/create',
                'created_at' => '2017-09-23 05:35:50',
                'updated_at' => '2017-09-23 07:34:12',
            ),
            21 => 
            array (
                'id' => 22,
                'parent_id' => 0,
                'order' => 22,
                'title' => '商品',
                'icon' => 'fa-shopping-bag',
                'uri' => NULL,
                'created_at' => '2017-09-23 07:30:56',
                'updated_at' => '2017-09-23 07:52:13',
            ),
            22 => 
            array (
                'id' => 23,
                'parent_id' => 22,
                'order' => 23,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'items',
                'created_at' => '2017-09-23 07:32:26',
                'updated_at' => '2017-09-23 07:52:13',
            ),
            23 => 
            array (
                'id' => 24,
                'parent_id' => 0,
                'order' => 24,
                'title' => '品类',
                'icon' => 'fa-delicious',
                'uri' => NULL,
                'created_at' => '2017-09-23 07:46:47',
                'updated_at' => '2017-09-23 07:52:13',
            ),
            24 => 
            array (
                'id' => 25,
                'parent_id' => 24,
                'order' => 25,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'categories',
                'created_at' => '2017-09-23 07:47:17',
                'updated_at' => '2017-09-23 07:52:13',
            ),
            25 => 
            array (
                'id' => 26,
                'parent_id' => 24,
                'order' => 26,
                'title' => '创建',
                'icon' => 'fa-plus',
                'uri' => 'categories/create',
                'created_at' => '2017-09-23 07:47:44',
                'updated_at' => '2017-09-23 07:52:13',
            ),
            26 => 
            array (
                'id' => 27,
                'parent_id' => 0,
                'order' => 32,
                'title' => '款式',
                'icon' => 'fa-adjust',
                'uri' => NULL,
                'created_at' => '2017-09-23 07:53:09',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            27 => 
            array (
                'id' => 28,
                'parent_id' => 27,
                'order' => 33,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'styles',
                'created_at' => '2017-09-23 07:53:24',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            28 => 
            array (
                'id' => 29,
                'parent_id' => 27,
                'order' => 34,
                'title' => '创建',
                'icon' => 'fa-plus',
                'uri' => 'styles/create',
                'created_at' => '2017-09-23 07:53:45',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            29 => 
            array (
                'id' => 30,
                'parent_id' => 0,
                'order' => 29,
                'title' => '颜色',
                'icon' => 'fa-tachometer',
                'uri' => NULL,
                'created_at' => '2017-09-23 09:24:00',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            30 => 
            array (
                'id' => 31,
                'parent_id' => 30,
                'order' => 30,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'colors',
                'created_at' => '2017-09-23 09:24:26',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            31 => 
            array (
                'id' => 32,
                'parent_id' => 30,
                'order' => 31,
                'title' => '创建',
                'icon' => 'fa-plus',
                'uri' => 'colors/create',
                'created_at' => '2017-09-23 09:24:40',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            32 => 
            array (
                'id' => 33,
                'parent_id' => 0,
                'order' => 27,
                'title' => '订单',
                'icon' => 'fa-list-alt',
                'uri' => NULL,
                'created_at' => '2017-10-04 15:06:05',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            33 => 
            array (
                'id' => 34,
                'parent_id' => 33,
                'order' => 28,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'orders',
                'created_at' => '2017-10-04 15:07:17',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            34 => 
            array (
                'id' => 35,
                'parent_id' => 0,
                'order' => 35,
                'title' => '礼品',
                'icon' => 'fa-gift',
                'uri' => NULL,
                'created_at' => '2017-10-20 10:44:51',
                'updated_at' => '2017-10-20 10:45:11',
            ),
            35 => 
            array (
                'id' => 36,
                'parent_id' => 35,
                'order' => 0,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'gifts',
                'created_at' => '2017-10-20 10:45:43',
                'updated_at' => '2017-10-20 10:45:43',
            ),
            36 => 
            array (
                'id' => 37,
                'parent_id' => 35,
                'order' => 0,
                'title' => '创建',
                'icon' => 'fa-plus',
                'uri' => 'gifts/create',
                'created_at' => '2017-10-20 10:46:17',
                'updated_at' => '2017-10-20 10:46:17',
            ),
            37 => 
            array (
                'id' => 38,
                'parent_id' => 0,
                'order' => 0,
                'title' => '优惠券',
                'icon' => 'fa-ticket',
                'uri' => NULL,
                'created_at' => '2017-10-21 14:45:48',
                'updated_at' => '2017-10-21 14:45:48',
            ),
            38 => 
            array (
                'id' => 39,
                'parent_id' => 38,
                'order' => 0,
                'title' => '列表',
                'icon' => 'fa-list',
                'uri' => 'coupons',
                'created_at' => '2017-10-21 14:46:15',
                'updated_at' => '2017-10-21 14:46:15',
            ),
            39 => 
            array (
                'id' => 40,
                'parent_id' => 38,
                'order' => 0,
                'title' => '创建',
                'icon' => 'fa-plus',
                'uri' => 'coupons/create',
                'created_at' => '2017-10-21 14:46:36',
                'updated_at' => '2017-10-21 14:46:36',
            ),
        ));
        
        
    }
}