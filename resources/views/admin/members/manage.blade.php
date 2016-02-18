@extends( 'admin.header' )

@section( 'content' )
<div class="portlet light bordered">
    <div class="portlet-title bb-none mb-none">
        <div class="inputs">
            <div class="portlet-input input-inline">
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input name="search_query" id="search" type="text" class="form-control input-circle" placeholder="{{ trans( 'members.fields.search.placeholder' ) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> {{ trans( 'members.table.id' ) }} </th>
                        <th> {{ trans( 'members.table.name' ) }} </th>
                        <th> {{ trans( 'members.table.balance' ) }} </th>
                        <th> {{ trans( 'members.table.joined' ) }} </th>
                        <th> {{ trans( 'members.table.actions' ) }} </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $users as $user )
                        <tr>
                            <td> {{ $user->id }} </td>
                            <td> {{ $user->username }} </td>
                            <td> {{ $user->balance() }} </td>
                            <td> {{ $user->created_at->format( 'l, F jS, Y' ) }} </td>
                            <td>
                                @if( Auth::user()->can( 'manage-users' ) )
                                    <a class="btn red btn-outline" href="{{ url( 'admin/members/balance/' . $user->id ) }}"> {{ trans( 'members.actions.give' ) }} </a>
                                @endif
                                @if( Auth::user()->can( 'manage-permissions' ) )
                                    <a class="btn blue btn-outline" href="{{ url( 'admin/members/permissions/' . $user->id ) }}"> {{ trans( 'members.actions.permissions' ) }} </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $users->render() !!}
        </div>
    </div>
</div>
@endsection

@section( 'footer' )
    @parent
    <script>
        $("#search").keyup(function(){
            table = $('table tbody');
            $.ajax({
                method: 'POST',
                url: "{{ url( 'admin/members/search' ) }}",
                data: {
                    '_token' : "{{ csrf_token() }}",
                    'search_query' : $("input[name='search_query']").val()
                },
                success: function (response) {
                    table.empty();
                    for (var i = 0; i < response.length; i++)
                    {
                        table.append(response[i]);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection