@include('admin.header')
@include('admin.sidebar')

<div class="content">
	<div class="container-fluid">
		<div class="row">
		
			
			<div class="col-lg-12 col-md-7">
				<div class="card">
					<div class="header">
						<h4 class="title">Seans Ekle</h4>
					</div>
					<div class="content">
						<form enctype="multipart/form-data" id="add_showtimes">


							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Film</label>
										<select name="movie_id" class="form-control border-input" >
											<option selected="selected" value="">- Film Seçiniz -</option>
											@foreach($movies as $movie)
												<option value="{{ $movie->id }}">{{ $movie->movie_name }}</option>
											@endforeach
										</select>


									</div>
								</div>
							</div>    

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Gösterime Girdiği Sinema</label>
										
										<select name="location" class="form-control border-input" >
											<option value="">- Sinema Seçiniz -</option>
											@foreach($cityList as $k=>$v)
												<option value="{{ $k }}">{{ $v }}</option>
											@endforeach
										</select>

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Seans Saati</label>
										<br />
										<input id="datetimepicker" type="text" class="form-control border-input" >
										<input name="movie_time"  type="text" class="form-control border-input" >

									</div>
								</div>
							</div>

	
	
							<div class="text-center">
								<button type="submit" class="btn btn-info btn-fill btn-wd">Ekle</button>
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

