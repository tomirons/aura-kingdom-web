@extends( 'admin.header' )

@section( 'content' )
    <div class="portlet light bordered">
        <div class="portlet-body form">
            <form action="{{ url( 'admin/members/permissions/' . $user->id ) }}" method="post" class="form-horizontal">
                {!! csrf_field() !!}
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="role">{{ trans( 'members.fields.role.label' ) }}</label>
                        <div class="col-md-9">
                            <select class="form-control" id="role" name="role">
                                <option value="0">{{ trans( 'members.roles.member' ) }}</option>
                                @foreach( \App\Role::all() as $role )
                                    <option value="{{ $role->id }}">{{ trans( 'members.roles.' . $role->name ) }}</option>
                                @endforeach
                            </select>
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