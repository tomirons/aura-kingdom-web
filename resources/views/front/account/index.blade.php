@extends( 'front.header' )

@section( 'content' )
    <div class="portlet light">
        <div class="portlet-body">
            <div class="tabbable-custom nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#overview" data-toggle="tab"> <i class="icon-speedometer"></i> {{ trans( 'main.acc_tabs.overview.title' ) }} </a>
                    </li>
                    <li>
                        <a href="#password" data-toggle="tab"> <i class="icon-lock"></i> {{ trans( 'main.acc_tabs.password.title' ) }} </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="overview">
                        <div class="portlet-body form">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">{{ trans( 'main.acc_tabs.overview.fields.name' ) }}</label>
                                                    <div class="col-md-9">
                                                        <div class="form-control form-control-static"> {{ Auth::user()->username }} </div>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">{{ trans( 'main.acc_tabs.overview.fields.password' ) }}</label>
                                                    <div class="col-md-9">
                                                        <div class="form-control form-control-static"> ******** </div>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="password">
                        <div class="portlet light">
                            <div class="portlet-body form">
                                <form action="{{ url( 'account/settings/password' ) }}" method="post" class="form-horizontal">
                                    {!! csrf_field() !!}
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-3 control-label" for="current_password">{{ trans( 'main.acc_tabs.password.fields.current' ) }}</label>
                                            <div class="col-md-9">
                                                <input name="current_password" type="password" class="form-control" id="current_password">
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block">{{ trans( 'main.acc_tabs.password.fields.current_desc' ) }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-3 control-label" for="new_password">{{ trans( 'main.acc_tabs.password.fields.new' ) }}</label>
                                            <div class="col-md-9">
                                                <input name="new_password" type="password" class="form-control" id="new_password">
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-3 control-label" for="new_password_confirmation">{{ trans( 'main.acc_tabs.password.fields.confirm' ) }}</label>
                                            <div class="col-md-9">
                                                <input name="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation">
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-2 col-md-9">
                                                <button type="submit" class="btn green">{{ trans( 'main.save' ) }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection