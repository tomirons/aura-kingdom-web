@extends( 'admin.header' )

@section( 'content' )
    <div class="portlet light bordered">
        <div class="portlet-body form">
            {!! Form::model( $news, [ 'method' => 'PATCH', 'action' => ['Admin\NewsController@update', $news->id], 'class' => 'form-horizontal' ] ) !!}
                @include( 'admin.news.form', [ 'submitButtonText' => trans( 'news.update_button' ) ] )
            {!! Form::close() !!}
        </div>
    </div>
@endsection