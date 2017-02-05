@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <div class="">
                        @foreach( $posts as $post )
                        <div class="list-group">
                            <div class="list-group-item">
                                <h3><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
                                    
                                    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                                    @if($post->active == '1')
                                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
                                    @else
                                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a></button>
                                    @endif
                                    @endif
                                </h3>
                                <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>

                                <iframe src="{{ $post->map }}" width="300px" height="100px" frameborder="0" style="border:0" allowfullscreen></iframe>
                                <?php $images=json_decode($post->image);

                                    if ($images)
                                    {
                                    ?>
                                <div class="container">
                                    <br>
                                    <div id="myCarousel{{ $post->id }}" class="carousel slide" style="width: 500px" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel{{ $post->id }}" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel{{ $post->id }}" data-slide-to="1"></li>
                                            <li data-target="#myCarousel{{ $post->id }}" data-slide-to="2"></li>
                                            <li data-target="#myCarousel{{ $post->id }}" data-slide-to="3"></li>
                                        </ol>

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <img src="img_chania.jpg" alt="Chania" width="460" height="345">
                                            </div>

                                <?php
                                        foreach ($images as $img){

                               ?>

                                <div class="item ">
                                    <img src="{{ URL::asset('img/'.$img)}}" alt="Chania" width="460" height="345">
                                </div>


                              <?php }
                                        ?>

                                        </div>

                                        <!-- Left and right controls -->
                                        <a class="left carousel-control" href="#myCarousel{{ $post->id }}"  role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel{{ $post->id }}"  role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                }?>
                            </div>
                            <div class="list-group-item">
                                <article>
                                    {!! str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
                                </article>
                            </div>
                        </div>
                        @endforeach
                        {!! $posts->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
