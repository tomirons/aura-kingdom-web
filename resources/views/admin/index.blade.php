@extends( 'admin.header' )

@section( 'content' )
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-red bold uppercase">Game Stats</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6 mb-md">
                        <div class="dashboard-stat blue">
                            <div class="visual">
                                <i class="icon-user"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{ $online_players }}">0</span>
                                </div>
                                <div class="desc"> {{ trans( 'widget.players_online_title' ) }} </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-md">
                        <div class="dashboard-stat purple">
                            <div class="visual">
                                <i class="icon-users"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{ count( \App\User::all() ) }}">0</span>
                                </div>
                                <div class="desc"> {{ trans( 'widget.acc_registered_title' ) }} </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-md">
                        <div class="dashboard-stat yellow-gold">
                            <div class="visual">
                                <i class="icon-user"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{ DB::connection( 'game' )->table( 'player_characters' )->count() }}">0</span>
                                </div>
                                <div class="desc"> {{ trans( 'widget.total_characters_title' ) }} </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-md">
                        <div class="dashboard-stat green">
                            <div class="visual">
                                <i class="icon-users"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{ DB::connection( 'game' )->table( 'family' )->count() }}">0</span>
                                </div>
                                <div class="desc"> {{ trans( 'widget.total_families_title' ) }} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-red bold uppercase">AK Web Releases</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="list-group">
                    @foreach( $releases as $release )
                        {{--*/ $date = new \Carbon\Carbon( $release['published_at'] ) /*--}}
                        <a target="_blank" href="{{ $release['zipball_url'] }}" class="list-group-item">
                            <h4 class="list-group-item-heading">{{ $release['name'] }} {!! ( $date > \Carbon\Carbon::now()->subHours( 48 ) ) ? '<span class="badge badge-danger badge-roundless">' . trans( 'system.releases.new' ) . '</span>' : NULL !!}</h4>
                            @if( $release['prerelease'] )
                                <div class="note note-danger mt-md">
                                    <h4 class="block"> {{ trans( 'system.releases.notice.title' ) }} </h4>
                                    <p> {!! trans( 'system.releases.notice.body', ['tag' => $release['tag_name']] ) !!} </p>
                                </div>
                            @endif
                            <p class="list-group-item-text"> {!! $release['body'] !!} </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection