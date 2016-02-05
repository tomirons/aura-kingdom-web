@extends( 'front.header' )

@section( 'content' )
    @include( 'errors.list' )
    <div class="col-md-9">
        <div class="row">
            @if( $items->count() > 0 )
                @foreach( $items as $item )
                    <div class="col-md-6">
                        <form action="{{ url( 'shop/purchase/' . $item->id ) }}" method="post">
                            {!! csrf_field() !!}
                            <div class="grid-item box bg-white">
                                <div class="grid_icon">
                                    <img width="32" src="{{ asset( File::exists( base_path( 'public/img/icons/' . $item->item_id . '.png' ) ) ? 'img/icons/' . $item->item_id . '.gif' : 'img/icons/unknown.png' ) }}" alt="{{ $item->name }}">
                                </div>
                                <div class="grid-item-title">
                                    <span class="font-dark">{{ $item->name }}</span>
                                </div>
                                <div class="grid-item-price font-blue">
                                    @if ( $item->discount)
                                        <s>{{ $item->price }}</s> <span class="font-red">{{ $item->price - ( ( $item->price / 100 ) * $item->discount ) }}</span> {{ settings( 'currency_name' ) }}
                                    @else
                                        {{ $item->price . ' ' . settings( 'currency_name' ) }}
                                    @endif
                                </div>
                                <div class="caption mt-xs p-sm">
                                    <div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible="1" data-rail-color="#111" data-handle-color="#000">
                                        {!! $item->description !!}
                                    </div>
                                    <div class="grid-item-buy text-center mt-md">
                                        @if ( $item->shareable )
                                            <button class="btn purple gift-button" data-toggle="modal" data-target="#giftModal_{{ $item->id }}"><i class="icon-paper-plane"></i> {{ trans( 'shop.gift' ) }} </button>
                                        @endif
                                        <button class="btn green">{{ trans( 'shop.buy' ) }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="giftModal_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="{{ url( 'shop/gift/' . $item->id ) }}" data-abide>
                                {!! csrf_field() !!}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{ trans( 'shop.gift_title', ['name' => $item->name]) }}</h4>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary " name="submit" type="submit">{{ trans( 'shop.send_gift' ) }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="portlet light">
                    <h4 class="portlet-body text-center mb-sm p-none">
                        {{ trans( 'main.no_results') }}
                    </h4>
                </div>
            @endif
        </div>
        <div class="row text-center">
            {!! $items->render() !!}
        </div>
    </div>
@endsection

@section( 'footer' )
    @parent
    <script>
        $(".gift-button").click(function(e){
            e.preventDefault(); // cancel default behavior
        });
    </script>
@endsection