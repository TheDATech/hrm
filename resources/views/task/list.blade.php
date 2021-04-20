@extends('layouts.master')
@section('title', 'Tasks')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
@stop
@section('content')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>All Tasks</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{url('task/create')}}">Add Task</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="admin-datatable table table-hover" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>project</th>
                                <th>Employee</th>
                                <th>Task No</th>
                                <th>Priority</th>
                                <th>Assign Date</th>
                                <th>Deadline Date</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>project</th>
                                <th>Employee</th>
                                <th>Task No</th>
                                <th>Priority</th>
                                <th>Assign Date</th>
                                <th>Deadline Date</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    {{$task->project_id ? $task->project->title : null}}
                                </td>
                                <td>
                                    {{$task->employee_id ? $task->employee->first_name.' '.$task->employee->middle_name.' '.$task->employee->last_name : null}}
                                </td>
                                <td>{{$task->task_no}}</td>
                                <td>
                                    @if ($task->priority == 'normal')
                                        <span class="badge badge-primary">{{$task->priority}}</span>
                                    @elseif($task->priority == 'medium')
                                        <span class="badge badge-warning">{{$task->priority}}</span>
                                    @elseif($task->priority == 'high')
                                        <span class="badge badge-danger">{{$task->priority}}</span>
                                    @endif
                                </td>
                                <td>
                                    {{$task->assign_date ? \Carbon\Carbon::parse($task->assign_date)->format('j F, Y') : null}}
                                </td>
                                <td>
                                    {{$task->deadline_date ? \Carbon\Carbon::parse($task->deadline_date)->format('j F, Y') : null}}
                                </td>
                                <td>
                                    @if ($task->status == 'ongoing')
                                        <span class="badge badge-primary">{{$task->status}}</span>
                                    @elseif($task->status == 'completed')
                                        <span class="badge badge-success">{{$task->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex;">
                                        <a href="{{url('task/'.$task->id.'/edit')}}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>
                                        {{-- <a href="{{url('task/'.$task->id)}}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="View"><i class="far fa-eye"></i></a> --}}
                                        <form action="{{url('task/'.$task->id)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('page-script')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
@stop