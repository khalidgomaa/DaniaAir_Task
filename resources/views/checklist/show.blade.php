@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Checklist Details</h2>
    
    <div class="mb-4">
        <strong>Inspector:</strong> {{ $checklist->user->name ?? 'Unknown' }} <br>
        <strong>Date:</strong> {{ $checklist->date }} <br>
        <strong>Time:</strong> {{ $checklist->time }} <br>
    </div>

    <h4 class="mb-3">Answers</h4>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Question</th>
                    <th>Response</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checklist->answers as $answer)
                    <tr>
                        <td>
                            <strong>{{ $answer->question->text_en  }}</strong><br>
                            <small class="text-muted">{{ $answer->question->text_ar  }}</small>
                        </td>
                        <td>{{ $answer->response }}</td>
                        <td>{{ $answer->comments ?? 'No comments' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('checklists.index') }}" class="btn btn-secondary mt-3">Back to All Checklists</a>
</div>
@endsection
