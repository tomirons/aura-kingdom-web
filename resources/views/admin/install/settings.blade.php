@extends( 'admin.install.header' )

@section( 'content' )
    <div class="col-md-4 col-md-offset-4">
        @if ( session('message') )
            <div class="alert alert-info">
                {{ session( 'message' ) }}
            </div>
        @endif
        @include( 'errors.list' )
        <form method="post" action="{{ route( 'admin.installer.settings.save' ) }}" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group form-md-line-input">
                <label class="col-md-4 control-label" for="server_name">{{ trans( 'system.server_name' ) }}</label>
                <div class="col-md-8">
                    <input name="server_name" type="text" class="form-control" id="server_name" placeholder="{{ trans( 'system.server_name' ) }}" value="{{ settings( 'server_name' ) }}">
                    <div class="form-control-focus"> </div>
                </div>
            </div>
            <div class="col-md-12 text-center mt-lg">
                <button class="btn btn-primary btn-lg">{{ trans( 'install.continue' ) }}</button>
            </div>
        </form>
    </div>
@endsection