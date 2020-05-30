@extends('layouts.app')

@section('content')

    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ trans('form.Home') }}</a></li>
                <li><a href="#">{{ trans('form.Blog') }}</a></li>
            </ol>
        </div>
    </section><!-- End Breadcrumbs -->
    <section id="blog" class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 entries">
                    <article class="entry entry-single">
                        <div class="entry-img">
                            <img src="/images/{{ $post->image }}" alt="" class="img-fluid">
                        </div>
                        <h2 class="entry-title">
                            {{ $post->title }}
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="icofont-user"></i> {{ $post->user->name }}</li>
                                <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i>
                                    <time datetime="{{ $post->created_at }}">{{ date('d-m-Y', strtotime($post->created_at)) }}</time>
                                </li>
                                <li class="d-flex align-items-center"><i class="icofont-comment"></i> {{ $post->comments->count() }} {{ trans('form.Comments') }}</li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            {!! $post->body !!}
                        </div>

                        <div class="entry-footer clearfix">
                            <div class="float-left">
                                <i class="icofont-folder"></i>
                                <ul class="cats">
                                    <li><a href="#">{{ $post->category->name }}</a></li>
                                </ul>

                                <i class="icofont-tags"></i>
                                <ul class="tags">
                                    @forelse ($post->tags as $tag)
                                        <li><a href="#">{{ $tag->name }}</a></li>
                                    @empty
                                        <li><a href="#">{{ trans('form.No_tag_found') }}</a></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="float-right share">
                                <a href="" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                                <a href="" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                                <a href="" title="Share on Instagram"><i class="icofont-instagram"></i></a>
                            </div>

                        </div>

                    </article><!-- End blog entry -->

                    <div class="blog-author clearfix">
                        <img src="/avatars/{{ $post->user->avatar }}" class="rounded-circle float-left" alt="">
                        <h4>{{ $post->user->name }}</h4>
                        <div class="social-links">
                            <a href="https://twitters.com/#"><i class="icofont-twitter"></i></a>
                            <a href="https://facebook.com/#"><i class="icofont-facebook"></i></a>
                            <a href="https://instagram.com/#"><i class="icofont-instagram"></i></a>
                        </div>
                    </div><!-- End blog author bio -->



                    @include('frontend._comments')

                    @includeWhen(Auth::user(), 'frontend._form')

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">{{ trans('form.Search') }}</h3>
                        <div class="sidebar-item search-form">
                            {!! Form::open(['url'=>'/','method' => 'GET', 'role' => 'form']) !!}
                                {!! Form::text('search', request()->get('search'), ['placeholder' =>  trans('form.Search').'...' ]) !!}
                                <button type="submit"><i class="icofont-search"></i></button>
                            {!! Form::close() !!}

                        </div><!-- End sidebar search formn-->

                        <h3 class="sidebar-title">{{ trans('form.Categories') }}</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                @forelse ($categories as $category)
                                    <li><a href="#">{{ $category->name }}<span>({{ $category->posts->count() }})</span></a></li>
                                @empty
                                    <li><a href="#">{{ trans('from.No_category_found') }}</a></li>
                                @endforelse
                            </ul>

                        </div><!-- End sidebar categories-->

                        @if (count($recent_posts) > 0)
                        <h3 class="sidebar-title">{{ trans('form.Recent_Posts') }}</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($recent_posts as $recent_post)
                                <div class="post-item clearfix">
                                    <img src="/images/{{ $post->image }}" alt="">
                                    <h4><a href="{{ url('posts/') }}/{{ $recent_post->id }}">{{ $recent_post->title }}</a></h4>
                                    <time datetime="{{ $recent_post->created_at }}">{{ date('d-m-Y', strtotime($post->created_at)) }}</time>
                                </div>
                            @endforeach
                        </div><!-- End sidebar recent posts-->
                        @endif

                        <h3 class="sidebar-title">{{ trans('form.Tags') }}</h3>
                        <div class="sidebar-item tags">
                            <ul>
                                @forelse ($tags as $tag)
                                    <li><a href="#">{{ $tag->name }}</li>
                                @empty
                                    <li><a href="#">{{ trans('form.No_tag_found') }}</a></li>
                                @endforelse
                            </ul>

                        </div><!-- End sidebar tags-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->

@endsection
