@extends('layouts.app')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ trans('form.Home') }}</a></li>
                <li>{{ trans('form.Blog') }}</li>
            </ol>
        </div>
    </section><!-- End Breadcrumbs -->
    <section id="blog" class="blog">
        <div class="container">
            @include('frontend._search')
            <div class="row">

                @forelse ($posts as $post)
                    <div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                        <article class="entry">

                            <div class="entry-img">
                                <img src="/images/{{ $post->image }}" alt="" class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="{{ url("/posts/{$post->id}") }}"> {{ $post->title }} </a>
                            </h2>

                            <div class="entry-meta">
                                @forelse ($post->tags as $tag)
                                    <ul>
                                        <li class="d-flex align-items-center">
                                            <i class="icofont-user"></i>{{ $post->user->name }}</li>
                                        <li class="d-flex align-items-center">
                                            <i class="icofont-tags"></i> {{ $tag->name }}</li>
                                        <li class="d-flex align-items-center">
                                            <i class="icofont-wall-clock"></i> {{ $post->created_at }}
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="icofont-wall-category"></i>
                                            <span>{{ trans('form.Comments') }} {{ $post->comments_count }}</span>
                                        </li>
                                    </ul>
                                @empty
                                <!--<span class="label label-danger">No tag found.</span>-->
                                @endforelse

                            </div>

                            <div class="entry-content">
                                <p>
                                    {!! str_limit($post->body, 200) !!}
                                </p>
                                <div class="read-more">
                                    <a href="{{ url("/posts/{$post->id}") }}">{{ trans('form.Read_More') }}</a>
                                </div>
                            </div>

                        </article><!-- End blog entry -->


                    </div>
                @empty
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('form.Not_Found') }}!!</div>

                        <div class="panel-body">
                            <p>{{ trans('form.Sorry_No_Post_found') }}.</p>
                        </div>
                    </div>
                @endforelse

                <div align="center">
                    {!! $posts->appends(['search' => request()->get('search')])->links() !!}
                </div>


            </div>
        </div>
    </section>

    <!-- End Blog Section -->

@endsection
