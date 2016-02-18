@extends( 'admin.header' )

@section( 'content' )
    <div class="portlet light bordered">
        <div class="portlet-body form">
            <form action="{{ url( 'admin/members/balance/' . $user->id ) }}" method="post" class="form-horizontal">
                {!! csrf_field() !!}
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="amount">{{ trans( 'members.fields.amount.label' ) }}</label>
                        <div class="col-md-9">
                            <input name="amount" type="number" class="form-control" id="amount">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn green">{{ trans( 'main.submit' ) }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection