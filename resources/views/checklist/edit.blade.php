@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Checklist</h2>
    @include('layouts.alert')


    <form action="{{ route('checklist.update', $checklist->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inspector">Inspector</label>
            <select id="inspector" name="inspector" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $checklist->inspector ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ $checklist->date }}">
        </div>

        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" id="time" name="time" class="form-control" value="{{ $checklist->time }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Checklist</button>
    </form>
</div>
@endsection
