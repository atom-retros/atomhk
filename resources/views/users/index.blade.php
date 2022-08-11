<x-layout.app>
    @push('title', 'Users')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">User Management</h3>

        <x-messages.flash-messages />

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">User List</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Motto</th>
                            <th>IP Address</th>
                            <th>Status</th>
                            <th>Last online</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="d-flex overflow-hidden" style="height: 50px;">
                                        <img class="avatar" src="https://imager.habstar.net/?figure={{ $user->look }}&direction=2&headonly=1&head_direction=2&gesture=sml" alt="">
                                        {{ $user->username }}
                                    </td>
                                    <td>{{ sensitiveInfo($user->mail) }}</td>
                                    <td>{{ $user->motto }}</td>
                                    <td>{{ sensitiveInfo($user->ip_current) }}</td>
                                    <td>{{ date('Y/m/d', $user->last_online) }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission(auth()->user(), 'edit_user'))
                                                <a href="{{ route('users.edit', $user) }}">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                            @endif

                                            @if(hasPermission(auth()->user(), 'delete_user'))
                                                <form class="ml-2" action="{{ route('user.destroy', $user) }}" method="POST">
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>