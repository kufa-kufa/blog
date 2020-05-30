<div class="row form-search">
    {!! Form::open(['method' => 'GET', 'role' => 'form']) !!}
    <div class="col-lg-8  col-md-12 d-flex align-items-stretch" data-aos="fade-up">
        {!! Form::text('search', request()->get('search'), ['class' => 'form-control', 'placeholder' =>  trans('form.Search').'...' ]) !!}
    </div>
    <div class="col-lg-4  col-md-12 d-flex align-items-stretch" data-aos="fade-up">
        {!! Form::submit(trans('form.Search'), ['class' => 'btn btn-block btn-default']) !!}
    </div>
    {!! Form::close() !!}
</div>
