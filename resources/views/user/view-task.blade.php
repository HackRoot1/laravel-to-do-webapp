@extends('layouts.header')

@section('main')

<div class="dash-content">
    <div class="activity">
        <div class="title">
            <div>
                <i class="uil uil-clock-two"></i>
                <span class="text">Tasks list</span>
            </div>
            <div>
                <i class="uil uil-plus-circle"></i>
                <a class="text" href="{{ route('account.add.task') }}">
                    <span>Add Task</span>
                </a>
            </div>
        </div>


        <div id="task_filters">
            <div class="links">
                <span class="checkboxBtn @if($status['status'] == 'none') active @endif"><a href="{{ route('account.view.task') }}">All</a></span>
                <!-- <span class = "checkboxBtn">Active</span> -->
                <span class="checkboxBtn @if($status['status'] == 0) active @endif"><a href="{{ route('account.view.task', ['task_status' => 0]) }}">Pending</a></span>
                <span class="checkboxBtn @if($status['status'] == 1) active @endif"><a href="{{ route('account.view.task', ['task_status' => 1]) }}">Completed</a></span>
                <!-- <span class="checkboxBtn">Incomplete</span> -->
            </div>

            <div class="options">
                <div id="sort-btn">
                    <i class="uil uil-sort"></i>
                    <span>Sort</span>
                </div>
            </div>
        </div>
        <div id="select-sort-options">
            <select name="sorts" id="sorting-filters">
                <option value="task_title">sort by name</option>
                <option value="task_category">sort by category</option>
                <option value="task_due_date">sort by date</option>
            </select>
        </div>


        <div id="result-data">
            @if(Session::has('success'))
            <div class="success-result">
                {{ Session::get('success') }}
            </div>

            @endif

            @if(Session::has('error'))
            <div class="error-result">
                {{ Session::get('error') }}
            </div>
            @endif
        </div>


        <table class="activity-data">
            <thead>
                <tr>
                    <th class="data names">
                        <div class="data-title">Title</div>
                    </th>
                    <th class="data email">
                        <div class="data-title">Description</div>
                    </th>
                    <th class="data joined">
                        <div class="data-title">Category</div>
                    </th>
                    <th class="data type">
                        <div class="data-title">Due Date</div>
                    </th>
                    <th class="data status">
                        <div class="data-title">Status</div>
                    </th>
                    <th class="data status" style="text-align: center">
                        <div class="data-title">Action</div>
                    </th>
                </tr>
            </thead>

            <tbody>
                
                @if($tasks->isNotEmpty())
                    @foreach($tasks as $task)
                        <tr>
                            <td class="data names">
                                <div class="data-list">{{ $task->task_title }}</div>
                            </td>
                            <td class="data email">
                                <div class="data-list">{{ $task->task_description }}</div>
                            </td>
                            <td class="data joined">
                                <div class="data-list">{{ $task->task_category }}</div>
                            </td>
                            <td class="data type">
                                <div class="data-list">{{ $task->task_due_date }}</div>
                            </td>
                            <td class="data status">
                                <div class="data-list">{{ ($task->task_status == 0) ? "Pending" : "Completed" }}</div>
                            </td>
                            <td class="data status">

                                <div class="data-list btns">
                                    <a href="{{ route('account.task.done', $task->id) }}">
                                        <i class="uil uil-check"></i>
                                    </a>
                                        <!-- Edit -->
                                    <a href="{{ route('account.task.edit', $task->id) }}">
                                        <i class="uil uil-edit"></i>
                                        <!-- Edit -->
                                    </a>
                                    <a href="{{ route('account.task.delete', $task->id) }}">
                                        <i class="uil uil-trash-alt"></i>
                                        <!-- Delete -->
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else 
                    <tr>
                        <td class="data names" colspan="5" style="text-align: center">
                            <div class="data-list">No records Found</div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection