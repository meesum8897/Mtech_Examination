<div class="question-box">

    <input
        type="hidden"
        name="attempt_answer_id"
        value="{{ $attemptAnswer->id }}">

    <div class="question">

        {{ $question->question }}

    </div>

    @if($question->question_type == 'MCQ')

        @foreach([
            'A' => $question->option_a,
            'B' => $question->option_b,
            'C' => $question->option_c,
            'D' => $question->option_d,
        ] as $key => $option)

            <label class="option">

                <input
                    type="radio"
                    name="selected_answer"
                    value="{{ $key }}"
                    {{ $attemptAnswer->selected_answer == $key ? 'checked' : '' }}>

                {{ $option }}

            </label>

        @endforeach

    @else

        <label class="option">

            <input
                type="radio"
                name="selected_answer"
                value="True"
                {{ $attemptAnswer->selected_answer == 'True' ? 'checked' : '' }}>

            True

        </label>

        <label class="option">

            <input
                type="radio"
                name="selected_answer"
                value="False"
                {{ $attemptAnswer->selected_answer == 'False' ? 'checked' : '' }}>

            False

        </label>

    @endif

</div>