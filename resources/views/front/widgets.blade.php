<h4 class="block mt-none pt-none">{{ trans( 'widget.status' ) }}</h4>
<ul class="list-group">
    <li class="list-group-item"> {{ trans( 'widget.client' ) }}
        <span class="badge badge-{{ $client_status ? 'success' : 'danger' }} badge-roundless"> {{ $client_status ? trans( 'widget.server_status_online' ) : trans( 'widget.server_status_offline' ) }} </span>
    </li>
    @foreach( $worlds as $world )
        {{--*/ $online = @fsockopen( settings( 'server_ip', '127.0.0.1' ), $world->port, $errCode, $errStr, 1 ) ? TRUE : FALSE; /*--}}
        <li class="list-group-item"> {{ $world->name }}
            <span class="badge badge-{{ $online ? 'success' : 'danger' }} badge-roundless"> {{ $online ? trans( 'widget.server_status_online' ) : trans( 'widget.server_status_offline' ) }} </span>
            @if ( $online )
                <span class="badge badge-info badge-roundless">{{ $world->online_user . '/' . $world->maxnum_user }}</span>
            @endif
        </li>
    @endforeach
</ul>