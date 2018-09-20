@extends('layouts.app')
@section('count')
{{ $count }}
@endsection
@section('friends_count')
{{ $friends_count }}
@endsection
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
			@endif
		</div>
		<div class="col-md-8">
			@if (session('success'))
			<div class="alert alert-success" role="alert">
				{{ session('success') }}
			</div>
			@endif
		</div>
	</div>
</div>
<div class="container container-fluid gedf-wrapper" >
	<div class="row gedf-main">
		<a href="{{'addPost'}}" class="btn btn-primary"> ADD NEW POST</a>
	</div>
	<hr />
	<div class="row">
		<div class="col-sm-8 gedf-main">
			<div class="row">
				<?php $count= count($posts); ?>
				@foreach ($posts as $key => $value)
				<div class="card gedf-card" style="width:100%;">
					<div class="card-header">
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex justify-content-between align-items-center">
								<div class="mr-2">
									<img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
								</div>
								<div class="ml-2">
									<div class="h5 m-0">{{ ucfirst($posts[$key]['user_first_name'] )}} &nbsp; </div>
								</div>
							</div>
							<div>
								<div class="dropdown">
									<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-ellipsis-h"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
										<div class="h6 dropdown-header">Configuration</div>
										<a class="dropdown-item" href="#">Save</a>
										<a class="dropdown-item" href="#">Hide</a>
										<a class="dropdown-item" href="#">Report</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>
						<a class="card-link" href="#">
							<h5 class="card-title">{{$posts[$key]['post_title']}}</h5>
						</a>
						<p class="card-text">
							{{$posts[$key]['post_description']}}
						</p>
						@if(!empty($posts[$key]['post_image']))
						<img class="card-img-bottom" src="{{asset('public/files/'.$posts[$key]['post_image'])}}"  style="width:50%">
						@endif
					</div>
					<div class="card-footer">
						<a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
						<a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	@endsection
