<div class="row">
    <div class="col-md-6">
        <div class="well bg-white">
            <ul class="nav nav-pills mb-none">
                <li {{ str_contains( Request::url(), 'player' ) ? 'class=active' : NULL }}><a href="{{ url( 'ranking' ) }}">{{ trans( 'ranking.player' ) }}</a></li>
                <li {{ str_contains( Request::url(), 'family' ) ? 'class=active' : NULL }}><a href="{{ url( 'ranking/family' ) }}">{{ trans( 'ranking.family' ) }}</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="well bg-white">
            <ul class="nav nav-pills mb-none">
                <li {{ str_contains( Request::url(), 'level' ) ? 'class=active' : NULL }}><a href="{{ url( 'ranking/' . Request::segment(2) . '/level' ) }}">{{ trans( 'ranking.type.level' ) }}</a></li>
                <li {{ str_contains( Request::url(), 'gold' ) ? 'class=active' : NULL }}><a href="{{ url( 'ranking/' . Request::segment(2) . '/gold' ) }}">{{ trans( 'ranking.type.gold' ) }}</a></li>
            </ul>
        </div>
    </div>
</div>