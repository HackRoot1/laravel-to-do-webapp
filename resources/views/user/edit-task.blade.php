@extends('layouts.header')

@section('main')

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-plus-circle"></i>
            <span class="text">Update Task</span>
        </div>
    </div>

    <div id="result-data">
        <div class="success-result"></div>
    </div>

    <form action="{{ route('account.update.task.data') }}" method="POST" id = "form-data">
        @csrf 
        <div>
            <label for="taskTitle">Task Title</label>
            <input type="hidden" value="{{ $tasks->id }}" name="task_id">
            <input type="text" value="{{ old('task_title', $tasks->task_title) }}" id="taskTitle" name="task_title">
        </div>
        @error('task_title')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <label for="taskDescription">Task Description</label>
            <input type="text" value="{{ old('task_description', $tasks->task_description) }}" id="taskDescription" name="task_description">
        </div>
        @error('task_description')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <label for="dateInput">Due Date</label>
            <input type="date" value="{{ old('due_date', $tasks->task_due_date) }}" id="dateInput" name="due_date">
        </div>
        @error('due_date')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <label for="category">Category</label>
            <input type="text" value="{{ old('category', $tasks->task_category) }}" id="category" name="category">
        </div>
        @error('category')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <div class="form-btn">
                <input type="reset" name="reset">
                <button type="submit" id="submitBtn">Update</button>
            </div>
        </div>
    </form>
</div>

@endsection