<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqTranslation;
use Illuminate\Database\Seeder;

class FAQSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Faq::truncate();
        FaqTranslation::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        $data = [ //1
            [
                'order' => '1',
                'en' => [
                    'question' => 'How do I write a good FAQ page?',
                    'answer' => '<p>Write questions from the point of view of your customer.
                    Write the FAQ sheet in an actual question-and-answer format.
                    Keep answers short.</p>',
                ],
                'es' => [
                    'question' => 'How do I write a good FAQ page?',
                    'answer' => '<p>Write questions from the point of view of your customer.
                    Write the FAQ sheet in an actual question-and-answer format.
                    Keep answers short.</p>',
                ],
            ],
            [
                'order' => '2',
                'en' => [
                    'question' => 'What should a FAQ page look like?',
                    'answer' => '<p>Write clear and concise pages. ...
                                Regularly update each page.</p>',
                ],
                'es' => [
                    'question' => '<p>What should a FAQ page look like?</p>',
                    'answer' => '<p>Write clear and concise pages. ...
                                Regularly update each page.</p>',
                ],
            ],
            [
                'order' => '3',
                'en' => [
                    'question' => 'How do you answer FAQs?',
                    'answer' => '<p> Start with Who, What, When, Where, How, Why (and Can) If you ve noticed, telephone support agents often repeat a question as you ask it. ...
                                Match the answer with the question. ...
                                Stay away from jargon. ...</p>',
                ],
                'es' => [
                    'question' => 'How do you answer FAQs?',
                    'answer' => '<p> Start with Who, What, When, Where, How, Why (and Can) If you ve noticed, telephone support agents often repeat a question as you ask it. ...
                                Match the answer with the question. ...
                                Stay away from jargon. ...</p>',
                ],
            ],
        ];
        foreach ($data as $one) {
            Faq::create($one);
        }
    }
}
