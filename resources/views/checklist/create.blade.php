@extends('layouts.app')

@section('content')
<div class="container border border-primary p-4 rounded">
<h2 class="my-4">Create Checklist </h2>
  
@include("layouts.alert")

    <form id="createChecklistForm" action="{{ route('checklists.store') }}" method="POST">
        @csrf

        @foreach($categories as $category)
            <h4 class="mt-4">{{ $category->name_en }} <small class="text-muted">{{ $category->name_ar }}</small></h4>
          
            <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Questions</th>
            <th>Responses</th>
            <th>Comments</th>
        </tr>
    </thead>
    <tbody>
        @foreach($category->questions as $question)
            <tr>
                <td>
                    <label>{{ $question->text_en }}<br><small class="text-muted">{{ $question->text_ar }}</small></label>
                </td>
                <td>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}][response]" value="yes">
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}][response]" value="no">
                        <label class="form-check-label">No</label>
                    </div>
                    <div class="invalid-feedback response-error"></div>
                </td>
                <td>
                    <input type="hidden" name="answers[{{ $question->id }}][question_id]" value="{{ $question->id }}">
                    <input type="text" name="answers[{{ $question->id }}][comments]" placeholder="Comments" class="form-control" />
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        @endforeach

        <div class="form-group col-md-4">
            <label for="date"><b>Date</b></label>
            <input type="date" id="date" name="date" class="form-control">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-4">
            <label for="time"><b>Time</b></label>
            <input type="time" id="time" name="time" class="form-control">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-4">
            <label for="inspector" class="text-bold"><b>Name of Inspector</b></label>
            <select id="inspector" name="inspector" class="form-control">
                <option value="" disabled selected>Choose the inspector</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Checklist</button>
    </form>
</div>
@endsection

@section('ajax-scripts')
<script>
    $(document).ready(function () {
        $('#createChecklistForm').on('submit', function (e) {
            e.preventDefault();

            let hasErrors = false;

            // Clear previous error messages
            $('.invalid-feedback').text('');
            $('.form-control').removeClass('is-invalid');

            // Check if all questions have been answered
            $('input[name*="[response]"]').each(function () {
                let questionId = $(this).attr('name').match(/\d+/)[0];
                let isAnswered = $(`input[name="answers[${questionId}][response]"]:checked`).length > 0;
                
                if (!isAnswered) {
                    hasErrors = true;
                    $(`input[name="answers[${questionId}][response]"]`).addClass('is-invalid');
                    $(`input[name="answers[${questionId}][response]"]`).siblings('.response-error').text('Please answer this question');
                }
            });

            // Validate other required fields
            if ($('#date').val() === '') {
                $('#date').addClass('is-invalid');
                $('#date').siblings('.invalid-feedback').text('Please select a date');
                hasErrors = true;
            }

            if ($('#time').val() === '') {
                $('#time').addClass('is-invalid');
                $('#time').siblings('.invalid-feedback').text('Please select a time');
                hasErrors = true;
            }

            if ($('#inspector').val() === null) {
                $('#inspector').addClass('is-invalid');
                $('#inspector').siblings('.invalid-feedback').text('Please select an inspector');
                hasErrors = true;
            }

            if (hasErrors) {
                return; // Stop form submission if there are validation errors
            }

            // If all questions have been answered, proceed with AJAX submission
            $.ajax({
                type: "POST",
                url: "{{ route('checklists.store') }}",
                data: $(this).serialize(),
                success: function (response) {
              
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            let fieldName = field.replace(/\./g, '\\.');
                            let errorMessage = errors[field][0];
                            
                            $(`[name="${fieldName}"]`).addClass('is-invalid');
                            $(`[name="${fieldName}"]`).siblings('.invalid-feedback').text(errorMessage);
                        }
                    } else {
                        alert("An error occurred. Please try again.");
                    }
                }
            });
        });

        // Remove error on question response selection
        $('input[name*="[response]"]').on('change', function () {
            // Get the question ID from the input name
            let questionId = $(this).attr('name').match(/\d+/)[0];

            // Remove is-invalid class and error message from both options (yes and no) for this question
            $(`input[name="answers[${questionId}][response]"]`).removeClass('is-invalid');
            $(`input[name="answers[${questionId}][response]"]`).siblings('.response-error').text('');
        });

        // Remove error on date, time, and inspector change
        $('#date').on('change', function () {
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').text('');
        });

        $('#time').on('change', function () {
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').text('');
        });

        $('#inspector').on('change', function () {
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').text('');
        });
    });
</script>
@endsection
