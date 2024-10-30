<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Category;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        $questions = [

            [
                'category' => 'General Work Environment',
                'questions' => [
                    [
                        'text_ar' => 'هل الأرضيات نظيفة وجافة وخالية من الانسكابات أو العوائق؟',
                        'text_en' => 'Are floors clean, dry, and free of spills or obstructions?',
                    ],
                    [
                        'text_ar' => 'هل الإضاءة كافية في جميع المناطق؟',
                        'text_en' => 'Is there adequate lighting in all areas?',
                    ],
                    [
                        'text_ar' => 'هل مخارج الطوارئ وطرق الطوارئ محددة بشكل واضح وغير مسدودة؟',
                        'text_en' => 'Are exits and emergency routes clearly marked and unobstructed?',
                    ],
                ]
            ],

            [
                'category' => 'Emergency Preparedness',
                'questions' => [
                    [
                        'text_ar' => 'هل أجهزة إطفاء الحرائق متوفرة ويمكن الوصول إليها وغير منتهية الصلاحية ويتم صيانتها بشكل صحيح؟',
                        'text_en' => 'Are fire extinguishers available, accessible, not expired, and properly maintained?',
                    ],
                    [
                        'text_ar' => 'هل يتم تدريب الموظفين على إجراءات الطوارئ وتدريبات الحرائق؟',
                        'text_en' => 'Are employees trained in emergency procedures and fire drills?',
                    ],
                    [
                        'text_ar' => 'هل تم تخزين معدات الإسعافات الأولية ويمكن الوصول إليها بسهولة؟',
                        'text_en' => 'Are first aid kits stocked and accessible?',
                    ],
                    [
                        'text_ar' => 'هل يتم نشر أرقام الاتصال في حالات الطوارئ في مناطق مرئية؟',
                        'text_en' => 'Are emergency contact numbers posted in visible areas?',
                    ],
                    [
                        'text_ar' => 'هل أجهزة كشف الدخان وأجهزة الإنذار بالحريق تعمل؟',
                        'text_en' => 'Are smoke detectors and fire alarms functional?',
                    ],
                    [
                        'text_ar' => 'هل يتم صيانة نظام الرش وتشغيله؟',
                        'text_en' => 'Is the sprinkler system maintained and operational?',
                    ],
                    [
                        'text_ar' => 'هل تم نشر خطط الإخلاء في حالات الطوارئ؟',
                        'text_en' => 'Are emergency evacuation plans posted?',
                    ],
                    [
                        'text_ar' => 'هل الموظفين على علم بإجراءات الإنذار من الحرائق والإخلاء؟',
                        'text_en' => 'Are employees aware of the fire alarm and evacuation procedure?',
                    ],
                ]
            ],

            [
                'category' => 'Personal Protective Equipment (PPE)',
                'questions' => [
                    [
                        'text_ar' => 'هل تتوفر معدات الحماية الشخصية المطلوبة للموظفين (مثل القفازات، نظارات السلامة، الخوذات، وسائل حماية السمع)؟',
                        'text_en' => 'Is the required PPE available for employees (e.g., gloves, safety goggles, helmets, hearing protection)?',
                    ],
                    [
                        'text_ar' => 'هل يتم تدريب الموظفين على الاستخدام الصحيح لمعدات الحماية الشخصية؟',
                        'text_en' => 'Are employees trained on the proper use of PPE?',
                    ],
                ]
            ],

            [
                'category' => 'Slips, Trips, and Falls',
                'questions' => [
                    [
                        'text_ar' => 'هل الأرضيات والممرات خالية من مخاطر التعثر (مثل الحبال والصناديق)؟',
                        'text_en' => 'Are floors and walkways free of tripping hazards (e.g., cords, boxes)?',
                    ],
                    [
                        'text_ar' => 'هل تم تخطيط الأرضيات لتحديد الممرات الآمنة وممرات مخصصة لمرور الآليات؟',
                        'text_en' => 'Are the floors planned to identify safe passages and dedicated passages for the passage of machinery?',
                    ],
                ]
            ],
        ];
        

        foreach ($questions as $data) {
            $category = Category::where('name_en', $data['category'])->first();

            foreach ($data['questions'] as $question) {
                Question::create([
                    'category_id' => $category->id,
                    'text_ar' => $question['text_ar'],
                    'text_en' => $question['text_en'],
                ]);
            }
        }
    }
}
