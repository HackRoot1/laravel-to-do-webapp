@extends('layouts.header')

@section('main')

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-plus-circle"></i>
            <span class="text">Add New Task</span>
        </div>
    </div>

    <div id="result-data">
        <div class="success-result"></div>
    </div>

    <form action="{{ route('account.add.task.data') }}" method="POST" id = "form-data">
        @csrf 
        <div>
            <label for="taskTitle">Task Title</label>
            <input type="text" value="{{ old('task_title') }}" id="taskTitle" name="task_title">
        </div>
        @error('task_title')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <label for="taskDescription">Task Description</label>
            <input type="text" value="{{ old('task_title') }}" id="taskDescription" name="task_description">
        </div>
        @error('task_description')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <label for="dateInput">Due Date</label>
            <input type="date" value="{{ old('task_title') }}" id="dateInput" name="due_date">
        </div>
        @error('due_date')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <label for="category">Category</label>
            <input type="text" value="{{ old('task_title') }}" id="category" name="category">
        </div>
        @error('category')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <div class="form-btn">
                <input type="reset" name="reset">
                <input type="submit" value="Submit" id="submitBtn">
            </div>
        </div>
    </form>
</div>

@endsection