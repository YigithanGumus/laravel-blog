<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda', 'Kariyer', 'Vizyonumuz', 'Misyonumuz'];
        $count = 0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'image' => 'https://img.freepik.com/free-photo/corporate-businessmen-working-tablet-office_53876-97637.jpg?w=2000',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry
                standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a
                type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised in the
                1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more
                recently with desktop publishing software like Aldus PageMaker including versions
                of Lorem Ipsum.',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
