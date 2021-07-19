<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        \Encore\Admin\Auth\Database\Menu::truncate();
        \Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "icon" => "fa-bar-chart",
                    "id" => 1,
                    "order" => 1,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "Dashboard",
                    "uri" => "/"
                ],
                [
                    "icon" => "fa-tasks",
                    "id" => 2,
                    "order" => 2,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "Admin",
                    "uri" => ""
                ],
                [
                    "icon" => "fa-users",
                    "id" => 3,
                    "order" => 3,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "管理员",
                    "uri" => "auth/users"
                ],
                [
                    "icon" => "fa-user",
                    "id" => 4,
                    "order" => 4,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "角色",
                    "uri" => "auth/roles"
                ],
                [
                    "icon" => "fa-ban",
                    "id" => 5,
                    "order" => 5,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "权限",
                    "uri" => "auth/permissions"
                ],
                [
                    "icon" => "fa-bars",
                    "id" => 6,
                    "order" => 6,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "菜单",
                    "uri" => "auth/menu"
                ],
                [
                    "icon" => "fa-history",
                    "id" => 7,
                    "order" => 7,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "操作日志",
                    "uri" => "auth/logs"
                ],
                [
                    "icon" => "fa-bars",
                    "id" => 8,
                    "order" => 0,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "话题管理",
                    "uri" => NULL
                ],
                [
                    "icon" => "fa-bars",
                    "id" => 9,
                    "order" => 0,
                    "parent_id" => 8,
                    "permission" => NULL,
                    "title" => "列表",
                    "uri" => "/topics"
                ],
                [
                    "icon" => "fa-bars",
                    "id" => 10,
                    "order" => 0,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "安财理财",
                    "uri" => NULL
                ],
                [
                    "icon" => "fa-bars",
                    "id" => 11,
                    "order" => 0,
                    "parent_id" => 10,
                    "permission" => NULL,
                    "title" => "课程列表",
                    "uri" => "/ancai_courses"
                ],
                [
                    "icon" => "fa-bars",
                    "id" => 12,
                    "order" => 0,
                    "parent_id" => 10,
                    "permission" => NULL,
                    "title" => "目录列表",
                    "uri" => "/ancai_catalogs"
                ],
                [
                    "icon" => "fa-bars",
                    "id" => 13,
                    "order" => 0,
                    "parent_id" => 10,
                    "permission" => NULL,
                    "title" => "文章列表",
                    "uri" => "/ancai_articles"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Permission::truncate();
        \Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "http_method" => "",
                    "http_path" => "*",
                    "id" => 1,
                    "name" => "All permission",
                    "slug" => "*"
                ],
                [
                    "http_method" => "GET",
                    "http_path" => "/",
                    "id" => 2,
                    "name" => "Dashboard",
                    "slug" => "dashboard"
                ],
                [
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout",
                    "id" => 3,
                    "name" => "Login",
                    "slug" => "auth.login"
                ],
                [
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting",
                    "id" => 4,
                    "name" => "User setting",
                    "slug" => "auth.setting"
                ],
                [
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
                    "id" => 5,
                    "name" => "Auth management",
                    "slug" => "auth.management"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Role::truncate();
        \Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "id" => 1,
                    "name" => "Administrator",
                    "slug" => "administrator"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "menu_id" => 2,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 11,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 12,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 13,
                    "role_id" => 1
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "permission_id" => 1,
                    "role_id" => 1
                ]
            ]
        );

        // users tables
        \Encore\Admin\Auth\Database\Administrator::truncate();
        \Encore\Admin\Auth\Database\Administrator::insert(
            [
                [
                    "avatar" => NULL,
                    "id" => 1,
                    "name" => "Administrator",
                    "password" => "\$2y\$10\$Cd/bEfFvn0CaYtD9fBKMI.FmyVpt58MRNxtLAzLDds1t.LCWfIJaW",
                    "remember_token" => "TqfN0G53kOyU7exL59tARRw9RqrJwiXECGZPLxx9d5sK9hHdmZOtpkgv8Lpw",
                    "username" => "admin"
                ]
            ]
        );

        DB::table('admin_role_users')->truncate();
        DB::table('admin_role_users')->insert(
            [
                [
                    "role_id" => 1,
                    "user_id" => 1
                ]
            ]
        );

        DB::table('admin_user_permissions')->truncate();
        DB::table('admin_user_permissions')->insert(
            [

            ]
        );

        // finish
    }
}
