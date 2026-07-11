@props([
    'attempt',
    'currentQuestion',
    'totalQuestions'
])

<div id="sidebarContainer" class="exam-sidebar" style="height: 100vh;">

    <h2>Question Summary</h2>

    <!-- LEGEND -->

    <div class="legend">

        <div class="legend-item">
            <div class="color green"></div>
            Answered
        </div>

        <div class="legend-item">
            <div class="color red"></div>
            Unanswered
        </div>

        <div class="legend-item">
            <div class="color yellow"></div>
            Current
        </div>

        <div class="legend-item">
            <div class="color gray"></div>
            Not Visited
        </div>

    </div>

    <!-- QUESTION GRID -->

    <div class="question-grid">

        @foreach($attempt->answers->sortBy('display_order') as $answer)

            @php

                $class = 'not-visited';

                if($answer->visited){

                    $class = empty($answer->selected_answer)
                                ? 'unanswered'
                                : 'answered';

                }

                if($answer->display_order == $currentQuestion){

                    $class = 'current';

                }

            @endphp

            <button
                type="button"
                class="q-btn {{ $class }}"
                data-question="{{ $answer->display_order }}">

                {{ $answer->display_order }}

            </button>

        @endforeach

    </div>

    @php

        $answered = $attempt->answers
                    ->whereNotNull('selected_answer')
                    ->count();

        $unanswered = $attempt->answers
                    ->where('visited', true)
                    ->whereNull('selected_answer')
                    ->count();

        $remaining = $attempt->answers
                    ->where('visited', false)
                    ->count();

        $progress = $totalQuestions
                    ? round(($answered / $totalQuestions) * 100)
                    : 0;

    @endphp

    <!-- PROGRESS -->

    <div class="progress-box">

        <h3>Exam Progress</h3>

        <div class="progress-bar">

            <div
                class="progress"
                style="width:{{ $progress }}%">
            </div>

        </div>

        <div class="stats">
            <span>Answered</span>
            <strong class="text-primary">{{ $answered }}</strong>
        </div>

        <div class="stats">
            <span>Unanswered</span>
            <strong style="color:var(--secondary-color)">
                {{ $unanswered }}
            </strong>
        </div>

        <div class="stats">
            <span>Remaining</span>
            <strong>{{ $remaining }}</strong>
        </div>

        <div class="stats">
            <span>Total Questions</span>
            <strong>{{ $totalQuestions }}</strong>
        </div>

    </div>

</div>