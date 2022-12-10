<x-layout.app>
    @push('title', 'Users')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">User Management</h3>

        <x-messages.flash-messages/>

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
                                <td class="d-flex overflow-hidden">
                                    <img style="widht: auto; height: auto;" class="avatar"
                                         src="{{ setting('avatar_imager') }}{{ $user->look }}&direction=2&headonly=1&head_direction=2&gesture=sml"
                                         alt="">
                                    {{ $user->username }}
                                </td>
                                <td>{{ sensitiveInfo($user->mail) }}</td>
                                <td>{{ $user->motto }}</td>
                                <td>{{ sensitiveInfo($user->ip_current) }}</td>
                                <td class="{{ $user->online ? 'text-success' : 'text-danger' }}">{{ $user->online ? 'Online' : 'Offline' }}</td>
                                <td>{{ date('Y/m/d', $user->last_online) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if(hasPermission('edit_user'))
                                            <a href="{{ route('users.edit', $user) }}">
                                                <x-elements.primary-button tooltip-text="{{ __('Edit user') }}">
                                                    <i class="fas fa-edit"></i>
                                                </x-elements.primary-button>
                                            </a>
                                        @endif

                                        @if(hasPermission('reset_user_password'))
                                            <a href="{{ route('users.password.edit', $user) }}" class="ml-2">
                                                <x-elements.success-button tooltip-text="{{ __('Reset password') }}">
                                                    <i class="fas fa-lock"></i>
                                                </x-elements.success-button>
                                            </a>
                                        @endif

                                        @if(hasPermission('delete_user'))
                                            <form class="ml-2" id="deleteUserForm" action="{{ route('user.destroy', $user) }}" method="POST" onSubmit="return confirm('Are you sure you want to delete this user?');">
                                                @method('DELETE')
                                                @csrf

                                                <x-elements.danger-button tooltip-text="{{ __('Delete user') }}">
                                                    <i class="fas fa-trash"></i>
                                                </x-elements.danger-button>
                                            </form>
                                        @endif

                                        @if(hasPermission('edit_user'))
                                            <form class="ml-2" action="{{ route('users.clones', $user) }}"
                                                  method="POST">
                                                @csrf

                                                <x-elements.warning-button tooltip-text="{{ __('Find clones') }}">
                                                    <i class="fas fa-eye"></i>
                                                </x-elements.warning-button>
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
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
