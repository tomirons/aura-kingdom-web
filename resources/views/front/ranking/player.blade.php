@extends( 'front.header' )

@section( 'content' )
    @include( 'front.ranking.nav' )
    <div class="portlet light">
        <div class="portlet-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> {{ trans( 'ranking.name' ) }} </th>
                        <th> {{ trans( 'ranking.class' ) }} </th>
                        <th> {{ trans( 'ranking.type.' . Request::segment( 3 ) ) }} </th>
                        <th> {{ trans( 'ranking.family' ) }} </th>
                    </tr>
                    </thead>
                    <tbody>
                        {{--*/ $count = ( ( $players->currentPage() - 1 ) * $players->perPage() ) + 1 /*--}}
                        @foreach( $players as $player )
                            <tr>
                                <td>
                                    <span class="badge badge-primary badge-roundless"> {{ $count }} </span>
                                </td>
                                <td> {{ $player->name }} </td>
                                <td> <span class="class s-16 c{{ $player->class }} pull-left mr-xs"></span> {{ trans( 'main.classes.' . $player->class ) }} </td>
                                <td>
                                    @if ( Request::is( 'ranking/*/level' ) )
                                        {{ $player->level }}
                                    @elseif ( Request::is( 'ranking/*/gold' ) )
                                        {{ gold_format( $player->gold / 1000 ) }}
                                    @elseif ( Request::is( 'ranking/*/pvp' ) )
                                        {{ $player->pk_count }}
                                    @endif
                                </td>
                                <td> {{ $player->family_name }} </td>
                            </tr>
                            {{--*/ $count++ /*--}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center">
        {!! $players->render() !!}
    </div>
@endsection