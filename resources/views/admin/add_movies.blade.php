@include('admin.header')
@include('admin.sidebar')

<div class="content">
    <div class="container-fluid">
        <div class="row">


            <div class="col-lg-12 col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Film Ekle</h4>
                    </div>
                    <div class="content">
                        <form enctype="multipart/form-data" id="add_movies">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Film Adı</label>
                                        <input required name="movie_name" type="text" class="form-control border-input"
                                               placeholder="" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Film Türü</label>

                                        <select required name="movie_genre[]" class="form-control border-input" multiple>
                                            @foreach($genreList as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
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
                                                  class="form-control border-input"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Poster</label>
                                        <input name="file" type="file"/>
                                        <input name="movie_poster" type="hidden">
                                        <br/>
                                        <progress value="0" max="100"></progress>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <img class="img-rounded pull-right movie_poster" style="max-width: 20%;"
                                             src="../assets/img/default-movie.png"
                                        >
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
