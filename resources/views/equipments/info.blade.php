@extends('layouts.app')

@section('content')
@foreach ($equipments as $equipment)
@if ($equipment->id == $id)
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                {{$equipment->equipment_name}}
                </div>
                <div class="panel-body">
                	<div class="form-group">
                		<label for="ip-address" class="col-sm-3 control-label">Ip Address</label> {{$equipment->ip_address}}</span> 
                	</div>
                	@foreach ($deviceModels as $deviceModel)
               		@if($deviceModel->id == $equipment->model_id)
               		<div class="form-group">
                		<label for="ip-address" class="col-sm-3 control-label">Device Model</label> {{$deviceModel->model_name}} 
                	</div>
                	@endif
                	@endforeach
                	<div class="form-group">
                		<label for="commands" class="col-sm-3 control-label">Available commands:</label>
                		<div class="col-sm-6">
                            <select class="form-control"  name="command">
                            @foreach ($commands as $command)
                            @foreach ($modelCommands as $modelCommand)
                            @if ($modelCommand->command_id == $command->id)
                            @if ($modelCommand->model_id == $equipment->model_id)
                          		<option value="{{ $command->command }}">{{ $command->command }}</option>
                          	@endif
                          	@endif
                          	@endforeach
                            @endforeach
                            </select>
                            <input type="text" name="argv" id="argv" class="form-control" placeholder="Arguments(if any)">
                        </div>
                		<button type="submit" class="btn btn-primary">
							<i class="fa fa-btn fa-terminal"></i>Run
                        </button>
                	</div>
                    <div class="form-group results">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
@endsection