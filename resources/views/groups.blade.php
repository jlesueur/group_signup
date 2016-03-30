@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
				<table class="table">
					<thead>
						<tr>
							<th>
								Groups
							</th>
							<th>
								Students
							</th>
						</tr>
					</thead>
					<tbody>
				@foreach ($groups as $group)
					<tr>
						<td>
							{{ $group->name }}
							@if (count($group->user) == 0)
								<button class="js-delete-group btn btn-xs btn-danger" data-groupId="{{ $group->id }}">delete</button>
							@endif
						</td>
						<td>
					@foreach ($group->user as $user)
							<div>
								{{ $user->name }} <button class="js-kick-user btn btn-xs btn-danger" data-userId="{{ $user->id }}">kick</button>
							</div>
					@endforeach
						</td>
					</tr>
				@endforeach
					</tbody>
				</table>
				<div class="col-md-1 col-md-offset-10">
					<button class="js-add-group btn btn-primary" data-toggle="modal" data-target="#groupModal">Create New Group</button>
				</div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="groupModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<form data-toggle="validator">
					<div class="form-group">
						<label for="InputName">Group Name</label>
						<input type="name" class="form-control" id="InputName" placeholder="Name" name="name" required>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary js-save-group">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
@endsection
