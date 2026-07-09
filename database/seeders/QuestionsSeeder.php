<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [

[
'question'=>'MS Word is used for?',
'question_type'=>'MCQ',
'option_a'=>'Typing',
'option_b'=>'Video Editing',
'option_c'=>'Gaming',
'option_d'=>'Programming',
'correct_answer'=>'A',
],

[
'question'=>'Which software is used for spreadsheets?',
'question_type'=>'MCQ',
'option_a'=>'MS Excel',
'option_b'=>'MS Word',
'option_c'=>'Paint',
'option_d'=>'Notepad',
'correct_answer'=>'A',
],

[
'question'=>'PowerPoint is mainly used for?',
'question_type'=>'MCQ',
'option_a'=>'Presentations',
'option_b'=>'Typing',
'option_c'=>'Database',
'option_d'=>'Programming',
'correct_answer'=>'A',
],

[
'question'=>'Shortcut key to Save a document?',
'question_type'=>'MCQ',
'option_a'=>'Ctrl + S',
'option_b'=>'Ctrl + P',
'option_c'=>'Ctrl + X',
'option_d'=>'Ctrl + V',
'correct_answer'=>'A',
],

[
'question'=>'Shortcut key to Copy?',
'question_type'=>'MCQ',
'option_a'=>'Ctrl + C',
'option_b'=>'Ctrl + X',
'option_c'=>'Ctrl + V',
'option_d'=>'Ctrl + Z',
'correct_answer'=>'A',
],

[
'question'=>'Shortcut key to Paste?',
'question_type'=>'MCQ',
'option_a'=>'Ctrl + V',
'option_b'=>'Ctrl + C',
'option_c'=>'Ctrl + A',
'option_d'=>'Ctrl + B',
'correct_answer'=>'A',
],

[
'question'=>'Which tab is used to insert pictures in Word?',
'question_type'=>'MCQ',
'option_a'=>'Insert',
'option_b'=>'Review',
'option_c'=>'View',
'option_d'=>'Mailings',
'correct_answer'=>'A',
],

[
'question'=>'Excel file extension is?',
'question_type'=>'MCQ',
'option_a'=>'.xlsx',
'option_b'=>'.docx',
'option_c'=>'.pptx',
'option_d'=>'.txt',
'correct_answer'=>'A',
],

[
'question'=>'Word file extension is?',
'question_type'=>'MCQ',
'option_a'=>'.docx',
'option_b'=>'.xlsx',
'option_c'=>'.pptx',
'option_d'=>'.exe',
'correct_answer'=>'A',
],

[
'question'=>'PowerPoint file extension is?',
'question_type'=>'MCQ',
'option_a'=>'.pptx',
'option_b'=>'.xlsx',
'option_c'=>'.docx',
'option_d'=>'.pdf',
'correct_answer'=>'A',
],

[
'question'=>'Which function adds numbers in Excel?',
'question_type'=>'MCQ',
'option_a'=>'SUM',
'option_b'=>'AVG',
'option_c'=>'COUNT',
'option_d'=>'MAX',
'correct_answer'=>'A',
],

[
'question'=>'Which key starts slideshow in PowerPoint?',
'question_type'=>'MCQ',
'option_a'=>'F5',
'option_b'=>'F2',
'option_c'=>'F7',
'option_d'=>'F12',
'correct_answer'=>'A',
],

[
'question'=>'Ctrl + B is used for?',
'question_type'=>'MCQ',
'option_a'=>'Bold',
'option_b'=>'Bookmark',
'option_c'=>'Border',
'option_d'=>'Background',
'correct_answer'=>'A',
],

[
'question'=>'Ctrl + I is used for?',
'question_type'=>'MCQ',
'option_a'=>'Italic',
'option_b'=>'Insert',
'option_c'=>'Indent',
'option_d'=>'Image',
'correct_answer'=>'A',
],

[
'question'=>'Ctrl + U is used for?',
'question_type'=>'MCQ',
'option_a'=>'Underline',
'option_b'=>'Undo',
'option_c'=>'Update',
'option_d'=>'Upload',
'correct_answer'=>'A',
],

[
'question'=>'Which view is best for editing slides?',
'question_type'=>'MCQ',
'option_a'=>'Normal',
'option_b'=>'Reading',
'option_c'=>'Slide Show',
'option_d'=>'Outline',
'correct_answer'=>'A',
],

[
'question'=>'Excel rows are identified by?',
'question_type'=>'MCQ',
'option_a'=>'Numbers',
'option_b'=>'Letters',
'option_c'=>'Symbols',
'option_d'=>'Colors',
'correct_answer'=>'A',
],

[
'question'=>'Excel columns are identified by?',
'question_type'=>'MCQ',
'option_a'=>'Letters',
'option_b'=>'Numbers',
'option_c'=>'Symbols',
'option_d'=>'Colors',
'correct_answer'=>'A',
],

[
'question'=>'Which menu is used to print a document?',
'question_type'=>'MCQ',
'option_a'=>'File',
'option_b'=>'Insert',
'option_c'=>'Layout',
'option_d'=>'Review',
'correct_answer'=>'A',
],

[
'question'=>'Ctrl + P is used for?',
'question_type'=>'MCQ',
'option_a'=>'Print',
'option_b'=>'Paste',
'option_c'=>'Preview',
'option_d'=>'Page Break',
'correct_answer'=>'A',
],


        // More questions...
    ];

    foreach ($questions as $question) {
        Question::create([
            ...$question,
            'is_active' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);
    }
    }
}
