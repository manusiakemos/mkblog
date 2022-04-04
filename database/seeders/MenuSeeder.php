<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $db = new Menu();
        $db->url = "/";
        $db->label = "parent";
        $db->type = "dropdown";
        $db->parent_id = 0;
        $db->save();

        $db2 = new Menu();
        $db2->url = "child";
        $db2->label = "child";
        $db2->type = "link";
        $db2->parent_id = $db->id;
        $db2->save();

        $db3 = new Menu();
        $db3->url = "home";
        $db3->label = "home";
        $db3->type = "link";
        $db3->parent_id = 0;
        $db3->save();

        $db4 = new Menu();
        $db4->url = "page";
        $db4->label = "page";
        $db4->type = "page";
        $db4->parent_id = 0;
        $db4->save();

    }
}
