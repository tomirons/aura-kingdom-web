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
                        <th> {{ trans( 'ranking.members' ) }} </th>
                        <th> {{ trans( 'ranking.type.' . Request::segment( 3 ) ) }} </th>
                        <th> {{ trans( 'ranking.leader' ) }} </th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/ $count = ( ( $families->currentPage() - 1 ) * $families->perPage() ) + 1 /*--}}
                    @foreach( $families as $family )
                        <tr>
                            <td>
                                <span class="badge badge-primary badge-roundless"> {{ $count }} </span>
                            </td>
                            <td> {{ $family->name }} </td>
                            <td> {{ $family->members }} </td>
                            <td>
                                @if ( Request::is( 'ranking/*/level' ) )
                                    {{ $family->level }}
                                @elseif ( Request::is( 'ranking/*/gold' ) )
                                    {{ gold_format( $family->gold / 1000 ) }}
                                @elseif ( Request::is( 'ranking/*/pvp' ) )
                                    {{ $family->pk_count }}
                                @endif
                            </td>
                            <td> {{ $family->leader }} </td>
                        </tr>
                        {{--*/ $count++ /*--}}
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center">
        {!! $families->render() !!}
    </div>
@endsection