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

                    <!-- New equipment Form -->
                    <form action="{{ url('equipment') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- equipment Name -->

                        <div class="form-group">
                            <label for="equipment-name" class="col-sm-3 control-label">Equipment Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="equipment_name" id="equipment-name" class="form-control" value="{{ old('equipment') }}">
                            </div>
                        </div>

                        <!-- equipment ip adress -->
                        <div class="form-group">
                            <label for="equipment-ip-address" class="col-sm-3 control-label">Equipment IP Address</label>

                            <div class="col-sm-6">
                                <input type="text" name="ip_address" id="equipment-ip-address" class="form-control" value="{{ old('equipment') }}">
                            </div>
                        </div>

                        <!-- ssh user -->

                        <div class="form-group">
                            <label for="ssh_user" class="col-sm-3 control-label">SSH User</label>

                            <div class="col-sm-6">
                                <input type="text" name="ssh_user" id="ssh_user" class="form-control" value="{{ old('equipment') }}">
                            </div>
                        </div>

                        <!--ssh password -->

                        <div class="form-group">
                            <label for="ssh_password" class="col-sm-3 control-label">SSH Password</label>

                            <div class="col-sm-6">
                                <input type="text" name="ssh_password" id="ssh_password" class="form-control" value="{{ old('equipment') }}">
                            </div>
                        </div>

                        <!-- dropdown for model names -->

                        <div class="form-group">
                            <label for="model" class="col-sm-3 control-label">Model Name</label>

                            <div class="col-sm-6">
                            <select class="form-control"  name="model_name">
                              @foreach ($deviceModels as $deviceModel)
                              <option value="{{ $deviceModel->id }}">{{ $deviceModel->model_name }}</option>
                              @endforeach
                            </select>
                            </div>
                        </div>
                        <!-- Add equipment Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add equipment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current equipments -->
            @if (count($equipments) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current equipments
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped equipment-table">
                            <thead>
                                <th>Equipment Name</th>                                
                                <th>Ip Address</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($equipments as $equipment)
                                    <tr>
                                        <td class="table-text"><div>{{ $equipment->equipment_name }}</div></td>
                                        <td class="table-text"><div>{{ $equipment->ip_address }}</div></td>
                                        <!-- equipment Delete Button -->
                                        <td>
                                            <form action="{{url('equipment/' . $equipment->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-equipment-{{ $equipment->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                        <form action="{{url('equipment/' . $equipment->id)}}" method="GET">
                                            {{ csrf_field() }}
                                            {{ method_field('GET') }}
                                            <button type="submit" id="info-equipment-{{ $equipment->id }}" class="btn btn-default">
                                                <i class="fa fa-btn fa-pencil"></i>Info
                                            </button>
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