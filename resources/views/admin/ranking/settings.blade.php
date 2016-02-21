@extends( 'admin.header' )

@section( 'content' )
    <div class="portlet light bordered">
        <div class="portlet-body form">
            <div class="portlet box red-flamingo">
                <div class="portlet-title">
                    <div class="caption"> {{ trans( 'main.cron.add' ) }} </div>
                </div>
                <div class="portlet-body">
                    <p>{{ trans( 'main.cron.info' ) }}</p>
                    <p>{{ trans( 'main.cron.job' ) }}</p>
                </div>
            </div>
            <form action="{{ url( 'admin/ranking/settings' ) }}" method="post" class="form-horizontal">
                {!! csrf_field() !!}
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        {!! Form::label( 'ignore_characters', trans( 'ranking.fields.ignore_characters' ), ['class' => 'col-md-2 control-label'] ) !!}
                        <div class="col-md-9">
                            {!! Form::text( 'ignore_characters', settings( 'ranking_ignore_characters' ), ['class' => 'form-control', 'id' => 'ignore_characters'] ) !!}
                            <div class="form-control-focus"> </div>
                            <span class="help-block">{{ trans( 'ranking.fields.ignore_characters_desc' ) }}</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        {!! Form::label( 'ignore_families', trans( 'ranking.fields.ignore_families' ), ['class' => 'col-md-2 control-label'] ) !!}
                        <div class="col-md-9">
                            {!! Form::text( 'ignore_families', settings( 'ranking_ignore_families' ), ['class' => 'form-control', 'id' => 'ignore_families'] ) !!}
                            <div class="form-control-focus"> </div>
                            <span class="help-block">{{ trans( 'ranking.fields.ignore_families_desc' ) }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn green">{{ trans( 'main.save_settings' ) }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection