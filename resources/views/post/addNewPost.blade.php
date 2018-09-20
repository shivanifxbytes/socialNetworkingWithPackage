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
			@if ($errors->any())
			<ul>
				@foreach ($errors->all() as $error)
				<li class="text-danger">
					{{ $error }}
				</li>
				@endforeach
			</ul>
			@endif
			<div class="card">

				<div class="card-header">{{ __('Add New Post') }}</div>
				<div class="card-body">
					<form method=POST  enctype="multipart/form-data" action="" aria-label="{{ __('Add New Post') }}">
						@csrf
						<div class="form-group row">
							<label for="post_title" class="col-md-4 col-form-label text-md-right">{{ __('Post Title') }}</label>
							<div class="col-md-6">
								<input id="post_title" type="text" class="form-control" name="post_title" value="{{ old('post_title') }}"  autofocus>
								@if($errors->has('post_title'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('post_title') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label for="post_description" class="col-md-4 col-form-label text-md-right">{{ __('Post Description') }}</label>
							<div class="col-md-6">
								<textarea id="post_description" class="form-control" name="post_description"   >
								</textarea>
								@if ($errors->has('post_description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('post_description') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label for="post_image" class="col-md-4 col-form-label text-md-right">{{ __('Post Image') }}</label>
							<div class="col-md-6">
								<input type="file" name="post_image" class="form-control">
								@if ($errors->has('post_description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('post_description') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Add New Post') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
