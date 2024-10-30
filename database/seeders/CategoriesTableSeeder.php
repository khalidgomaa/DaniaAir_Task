<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name_ar' => 'بيئة العمل العامة', 'name_en' => 'General Work Environment'],
            ['name_ar' => 'الاستعداد للطوارئ', 'name_en' => 'Emergency Preparedness'],
            ['name_ar' => 'معدات الحماية الشخصية (PPE)', 'name_en' => 'Personal Protective Equipment (PPE)'],
            ['name_ar' => 'الانزلاقات والتعثرات والسقوط', 'name_en' => 'Slips, Trips, and Falls'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
