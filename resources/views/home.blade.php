@extends('layouts.app')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
				@if (!empty($chosenGroup))
					You've chosen a group: {{ $chosenGroup->name }}
						@foreach ($chosenGroup->user as $user)
								<div>
									{{ $user->name }}
								</div>
						@endforeach
				@else
					<table class="table">
						<thead>
							<tr>
								<th>
									Groups
								</th>
								<th>
									Students
								</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
					@foreach ($groups as $group)
						@if (count($group->user) < 8)
						<tr>
							<td>
								{{ $group->name }}
							</td>
							<td>
						@foreach ($group->user as $user)
								<div>
									{{ $user->name }}
								</div>
						@endforeach
							</td>
							<td>
								<button class='btn btn-primary js-join' gs-groupId="{{ $group->id }}">Join</button>
							</td>
						</tr>
						@endif
					@endforeach
						</tbody>
					</table>
					
				@endif
                
            </div>
        </div>
    </div>
</div>
@endsection
