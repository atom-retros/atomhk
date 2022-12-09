<x-layout.app>
    @push('title', 'Bans')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">Bans Management</h3>

        <x-messages.flash-messages />

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Bans List</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>IP</th>
                            <th>Ban issuer</th>
                            <th>Banned at</th>
                            <th>Expires at</th>
                            <th>Ban reason</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($bans as $ban)
                                <tr>
                                    <td class="d-flex overflow-hidden" style="height: 50px;">
                                        <img class="avatar" src="{{ setting('avatar_imager') }}{{ $ban->user?->look }}&direction=2&headonly=1&head_direction=2&gesture=sml" alt="">
                                        {{ $ban->user?->username }}
                                    </td>
                                    <td>{{ sensitiveInfo($ban?->ip) }}</td>
                                    <td>{{ $ban->issuer?->username }}</td>
                                    <td>{{ date('Y/m/d H:i:s', $ban->timestamp) }}</td>
                                    <td>{{ date('Y/m/d H:i:s', $ban->ban_expire) }}</td>
                                    <td>{{ Str::limit($ban->ban_reason, 30) }}</td>
                                    <td>{{ $ban->type }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission('delete_user'))
                                                <form class="ml-2" action="{{ route('bans.destroy', $ban) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf

                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $bans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
