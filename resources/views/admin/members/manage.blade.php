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
                        <th> {{ trans( 'members.table.role' ) }} </th>
                        <th> {{ trans( 'members.table.actions' ) }} </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $users as $user )
                        <tr>
                            <td> {{ $user->id }} </td>
                            <td> {{ $user->username }} </td>
                            <td> {{ $user->balance() }} </td>
                            <td> {{ $user->role }} </td>
                            <td>
                                <a class="btn red btn-outline" data-toggle="modal" href="#{{ $user->username }}_balance"> {{ trans( 'members.actions.give' ) }} </a>
                                <div class="modal fade" id="{{ $user->username }}_balance" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url( 'admin/members/balance/' . $user->id ) }}" method="post">
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">{{ trans( 'members.modal.title', ['user' => $user->username] ) }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group form-md-line-input form-md-floating-label">
                                                        <input name="amount" type="text" class="form-control" id="amount">
                                                        <label for="amount">{{ trans( 'members.fields.amount.label' ) }}</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn dark btn-outline" data-dismiss="modal">{{ trans( 'members.modal.close' ) }}</button>
                                                    <button type="submit" class="btn green">{{ trans( 'members.modal.submit' ) }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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