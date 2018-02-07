@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					@if ({{ Auth::user()->role }} == "0")
					<div class="alert alert-danger">
						{{ session('status') }}
					</div>
					@endif You are logged in!
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
