@include('admin.header')
@include('admin.sidebar')

<div class="content">
	<div class="container-fluid">
		<div class="row">


			<div class="col-lg-12 col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="title">Film Düzenle</h4>
					</div>
					<div class="content">
						<form enctype="multipart/form-data" id="edit_movies">

							<input name="id" type="hidden" value="{{$movie->id}}">

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Film Adı</label>
										<input required name="movie_name" type="text" class="form-control border-input"
											   placeholder="" value="{{$movie->movie_name}}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Film Türü</label>

										<select required name="movie_genre[]" class="form-control border-input" multiple>
											@foreach($genreList as $key=>$value)
												<option value="{{$key}}" {{  (in_array($key, explode(',',$movie->movie_genre))) ? 'selected' : '' }}>{{$value}}</option>
											@endforeach
										</select>

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Detay</label>
										<textarea required name="movie_detail" rows="5"
												  class="form-control border-input">{{$movie->movie_detail}}</textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label>Poster</label>
										<input name="file" type="file"/>
										<input name="movie_poster" type="hidden" value="{{$movie->movie_poster}}">
										<br/>
										<progress value="0" max="100"></progress>

									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										@if(empty($movie->movie_poster))
											<img class="img-rounded pull-right movie_poster" style="max-width: 20%;"
												 src="../assets/img/default-movie.png"
											>
										@else
											<img class="img-rounded pull-right movie_poster" style="max-width: 20%;"
												 src="../uploads/{{$movie->movie_poster}}"
											>
										@endif


									</div>
								</div>
							</div>


							<div class="text-center">
								<button type="submit" class="btn btn-info btn-fill btn-wd">Düzenle</button>
							</div>

							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>


@include('admin.footer')
