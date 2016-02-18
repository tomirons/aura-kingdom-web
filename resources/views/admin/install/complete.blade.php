@extends( 'admin.install.header' )

@section( 'content' )
    <div class="col-md-4 col-md-offset-4 text-center">
        <p>{{ trans( 'install.complete.installed' ) }}</p>
        <p>{!! trans( 'install.complete.admin_account', ['password' => $password] ) !!}</p>
        <a href="/" class="btn btn-primary btn-lg">{{ trans( 'install.complete.exit' ) }}</a>
    </div>
@endsection