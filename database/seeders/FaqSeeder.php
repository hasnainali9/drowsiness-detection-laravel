<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FaqSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert 10 FAQs
        $faqs = [
            [
                'question' => 'What is drowsiness detection?',
                'answer' => 'Drowsiness detection is a technology that identifies and alerts individuals when they are becoming drowsy or fatigued.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'How does drowsiness detection work?',
                'answer' => 'Drowsiness detection systems typically use sensors to monitor various physiological and behavioral signs of drowsiness, such as eye movement, head position, and blink patterns.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Why is drowsiness detection important?',
                'answer' => 'Drowsy driving can lead to accidents due to impaired reaction time and decreased attentiveness. Drowsiness detection helps prevent such accidents by alerting drivers when they show signs of fatigue.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Are there different types of drowsiness detection technologies?',
                'answer' => 'Yes, there are various types of technologies, including camera-based systems that monitor facial features, wearable devices that track biometric data, and steering wheel sensors that detect changes in driving behavior.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Can drowsiness detection be used outside of driving?',
                'answer' => 'Yes, drowsiness detection technology can be applied in various contexts beyond driving, such as in industries where alertness is critical, including healthcare and manufacturing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'How accurate is drowsiness detection?',
                'answer' => 'The accuracy of drowsiness detection systems can vary depending on the technology used. Some advanced systems boast high accuracy by combining multiple sensors and machine learning algorithms.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Is drowsiness detection only for professional drivers?',
                'answer' => 'While drowsiness detection is commonly used in the transportation industry, it can benefit anyone who needs to stay alert, including students studying for exams, employees working long hours, and more.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Can drowsiness detection systems prevent accidents?',
                'answer' => 'While drowsiness detection systems can provide timely alerts, the ultimate goal is to prevent accidents by prompting individuals to take appropriate actions, such as taking breaks or pulling over to rest.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Are there any legal requirements for drowsiness detection in vehicles?',
                'answer' => 'As of now, there are no specific legal requirements mandating the use of drowsiness detection systems in vehicles. However, the importance of addressing drowsy driving is recognized, and some safety regulations may evolve over time.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'How can individuals benefit from drowsiness detection?',
                'answer' => 'Individuals can benefit from drowsiness detection by enhancing safety, reducing the risk of accidents, and improving overall well-being. It can be particularly valuable for those with demanding schedules or who engage in activities requiring sustained attention.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('faqs')->insert($faqs);

    }
}
