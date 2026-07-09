<x-admin.header title="Question Bank" breadcrumb="Question Bank" msg="Manage and organize examination questions"/>

{{-- ==========================================================
EXAM INFORMATION
========================================================== --}}

<div class="table-card mb-4">

    <div class="table-card-header">

        <h3>

            {{ $exam->exam_title }}

        </h3>

    </div>

    <div class="table-card-body">

        <div class="form-grid">

            <div>

                <strong>Course</strong><br>

                {{ $exam->course->course_name }}

            </div>

            <div>

                <strong>Duration</strong><br>

                {{ $exam->duration }} Minutes

            </div>

            <div>

                <strong>Passing Marks</strong><br>

                {{ $exam->passing_marks }}

            </div>

            <div>

                <strong>Status</strong><br>

                {{ $exam->status }}

            </div>

            <div>

                <strong>Total Questions</strong><br>

                {{ $questions->count() }}

            </div>

            <div>

                <strong>Total Marks</strong><br>

                {{ rtrim(rtrim(number_format($totalMarks, 2), '0'), '.') }}

            </div>

        </div>

    </div>

</div>





{{-- ==========================================================
ADD QUESTION
========================================================== --}}

<div class="table-card">

    <div class="table-card-header">

        <h3>

            Add New Question

        </h3>

    </div>

    <div class="table-card-body">

        <form action="{{ route('admin.exam.questions.store', $exam) }}" method="POST">
            @csrf

            <div class="form-group">

                <label>

                    Question Type

                </label>

                <select name="question_type" id="questionType" class="form-control">

                    <option value="MCQ">

                        MCQ

                    </option>

                    <option value="TrueFalse">

                        True / False

                    </option>

                </select>

            </div>

            <br>

            <div class="form-group">

                <label>

                    Question

                </label>

                <textarea name="question" rows="10" class="form-control @error('question') is-invalid @enderror">{{ old('question') }}</textarea>

                @error('question')
                <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <br>

            {{-- =======================
            MCQ OPTIONS
            ======================= --}}

            <div id="mcqOptions">

                <div class="form-grid">

                    <div>

                        <label>

                            Option A

                        </label>

                        <input type="text" name="option_a" value="{{ old('option_a') }}" class="form-control @error('option_a') is-invalid @enderror">

                        @error('option_a')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div>

                        <label>

                            Option B

                        </label>

                        <input type="text" name="option_b" value="{{ old('option_b') }}" class="form-control @error('option_b') is-invalid @enderror">
                        @error('option_b')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <br>

                <div class="form-grid">

                    <div>

                        <label>

                            Option C

                        </label>

                        <input type="text" name="option_c" value="{{ old('option_c') }}" class="form-control @error('option_c') is-invalid @enderror">
                        @error('option_c')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div>

                        <label>

                            Option D

                        </label>

                        <input type="text" name="option_d" value="{{ old('option_d') }}" class="form-control @error('option_d') is-invalid @enderror">
                        @error('option_d')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

            <br>

            <div class="form-grid">

                <div>

                    <label>

                        Correct Answer

                    </label>

                    <select name="correct_answer" id="correctAnswer" class="form-control">

                        <option value="A">

                            Option A

                        </option>

                        <option value="B">

                            Option B

                        </option>

                        <option value="C">

                            Option C

                        </option>

                        <option value="D">

                            Option D

                        </option>

                    </select>

                </div>

                <div>

                    <label>

                        Marks

                    </label>

                    <input
                        type="number"
                        name="marks"
                        class="form-control"
                        value="1">

                </div>

            </div>

            <br>

            <div class="text-end">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Save

                </button>

            </div>

        </form>

    </div>

</div>





{{-- ==========================================================
QUESTIONS TABLE
========================================================== --}}

<div class="table-card mt-4">

    <div class="table-card-header">

        <h3>

            Questions

        </h3>

    </div>

    <div class="table-responsive">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Question</th>

                    <th>Type</th>

                    <th>Correct</th>

                    <th>Marks</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($questions as $question)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ Str::limit($question->question,60) }}

                        </td>

                        <td>

                            {{ $question->question_type }}

                        </td>

                        <td>

                            {{ $question->correct_answer }}

                        </td>

                        <td>

                            {{ rtrim(rtrim(number_format($question->pivot->marks, 2), '0'), '.') }}
                        </td>

                        <td>

                            <div class="table-actions">

                                <button
                                    class="action-btn edit-btn">

                                    Edit

                                </button>

                                <form
                                    action="{{ route('admin.exam.questions.destroy', [$exam, $question]) }}"
                                    method="POST"
                                    class="question-delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="action-btn delete-btn">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" style="text-align:center;padding:25px;">

                            No Questions Added Yet.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>