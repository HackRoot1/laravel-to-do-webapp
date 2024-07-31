@extends('layouts.header')

@section('main')

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Dashboard</span>
        </div>
    </div>

    <div class="boxes">

        <!-- loading data and displaying here from page load_pending_or_completed_data.php -->
        <div class="box box1">
            <span class="text">Total Tasks :</span>
            <span class="number">{{ count($totalTasks) }}</span>
        </div>
        <div class="box box2">
            <span class="text">Completed Tasks :</span>
            <span class="number">
                {{ count($totalTasks) - count($tasks) }}
            </span>
        </div>
        <div class="box box3">
            <span class="text">Pending Tasks :</span>
            <span class="number">
                {{ count($tasks) }}
            </span>
        </div>
    </div>


    <div class="activity">
        <div class="title">
            <div>
                <i class="uil uil-clock-two"></i>
                <span class="text">Upcoming Tasks</span>
            </div>
        </div>

        <div id="result-data">
            <div class="success-result"></div>
            <div class="error-result"></div>
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