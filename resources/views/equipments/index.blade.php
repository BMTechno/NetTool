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
                            <label for="equipment-name" class="col-sm-3 control-label">Equipment</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="equipment-name" class="form-control" value="{{ old('equipment') }}">
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
                                <th>equipment</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($equipments as $equipment)
                                    <tr>
                                        <td class="table-text"><div>{{ $equipment->name }}</div></td>

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