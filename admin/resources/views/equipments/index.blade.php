@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Equipment
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('equipments') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="equipment-name" class="col-sm-3 control-label">Equipment</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('equipment_alias') }}">
                                <br>
                                <br>
                            </div>
                            <br>
                            <label for="ssh-user" class="col-sm-3 control-label">SSH User</label>
                            <div class="col-sm-6">
                                <input type="text" name="sshu" id="ssh-user" class="form-control" value="{{ old('ssh_user') }}">
                            </div>

                            <label for="ssh-password" class="col-sm-3 control-label">SSH Password</label>  
                            <div class="col-sm-6">
                                <input type="password" name="sshp" id="ssh-password" class="form-control" value="{{ old('ssh_password') }}">
                            </div>

                            <label for="ip-adress" class="col-sm-3 control-label">IP Adress</label>
                            <div class="col-sm-6">
                                <input type="text" name="ipa" id="ip-adress" class="form-control" value="{{ old('ip_adress') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Equipment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($equipments) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Equipments
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Equipment</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($equipments as $equipment)
                                    <tr>
                                        <td class="table-text"><div>{{ $equipment->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{url('equipments/' . $equipment->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-equipment-{{ $equipment->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection