<?php

use Illuminate\Database\Seeder;
use App\Models\Faqs;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = array(
            array(
                'question'   => 'What is DJ-Compilations.Com about?',
                'answer'     => 'DJ-Compilations.Com is a private pool, with lots of music, videos and tools for deejays.',
                'status'     => 1,
                'created_at' => date(DATETIME_FORMAT),
            ),
            array(
                'question'   => 'Who can join DJ-Compilations.Com private pool?',
                'answer'     => 'We provide our services for DJs, VJs, Remixers and Music producers.',
                'status'     => 1,
                'created_at' => date(DATETIME_FORMAT),
            ),
            array(
                'question'   => 'How can I join DJ-Compilations.Com private pool?',
                'answer'     => 'First, you need to register an account with us. The process is very simple and it takes no more than 2 minutes – Click here to Register.
Then you will have to wаit for verification from one of our staff members.
As soon as your account gets Verified you will receive an email confirming it, and you’ll be able to select your desired membership plan.',
                'status'     => 1,
                'created_at' => date(DATETIME_FORMAT),
            ),
            array(
                'question'   => 'How much it costs to enter the Private Pool?',
                'answer'     => 'Currently we have 3 types of membership:
Lite/19.99$ [30 days access] [150Gb download traffic included]
Regular/49.99$ [90 days access] [500Gb download traffic included]',
                'status'     => 1,
                'created_at' => date(DATETIME_FORMAT),
            ),
            array(
                'question'   => 'What payment methods does DJ-Compilations.Com accept?',
                'answer'     => 'We accept PayPal only.',
                'status'     => 1,
                'created_at' => date(DATETIME_FORMAT),
            ),
            array(
                'question'   => 'Do I need another premium account to download from the Private Pool?',
                'answer'     => 'No. All files are stored on a secure FTP site, that allows direct downloading without waiting or speed limit.',
                'status'     => 1,
                'created_at' => date(DATETIME_FORMAT),
            ),
            array(
                'question'   => 'Do I need any additional software to connect to the Private Pool?',
                'answer'     => 'Yes. You need an FTP client like Filezilla. There are plenty of free and paid FTP clients out there, so you don’t have to worry about that.',
                'status'     => 1,
                'created_at' => date(DATETIME_FORMAT),
            ),
        );
        foreach ($faqs as $faq) {
            $row = Faqs::where('question', $faq['question'])->first();
            if ($row === null) {
                DB::table('faqs')->insert($faq);
            }
        }
    }
}
