@extends('layouts.app')

@section('content')
<div class="container border border-primary p-4 rounded">
  
@include("layouts.alert")

    <form action="{{ route('checklist.store') }}" method="POST">
        @csrf

        @foreach($categories as $category)
            <h4 class="mt-4">{{ $category->name_en }} <small class="text-muted">{{ $category->name_ar }}</small></h4>
            <table class="table table-bordered">
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
            <input type="date" id="inspection_date" name="inspection_date" class="form-control" >
        </div>
        <div class="form-group col-md-4">
            <label for="time"><b>Time</b></label>
            <input type="time" id="inspection_time" name="time" class="form-control" >
        </div>
        <div class="form-group col-md-4">
        <label for="inspector" class="text-bold"><b>Name of Inspector</b></label>
        <select id="inspector" name="inspector" class="form-control">
            <option value="" disabled selected>choose the inspector</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Checklist</button>
    </form>
</div>
@endsection
