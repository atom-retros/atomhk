<x-layout.app>
    @push('title', 'Users')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Staff Applications Managements') }}</h3>

        <x-messages.flash-messages/>

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">
                    {{ __('Staff Applications') }}
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Rank applied for') }}</th>
                            <th>{{ __('Contents') }}</th>
                            <th>{{ __('Application Status') }}</th>
                            <th>{{ __('Activity Status') }}</th>
                            <th>{{ __('Manage') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td class="d-flex overflow-hidden">
                                    <img style="widht: auto; height: auto;" class="avatar"
                                         src="{{ setting('avatar_imager') }}{{ $application->user->look }}&direction=2&headonly=1&head_direction=2&gesture=sml"
                                         alt="">
                                    {{ $application->user->username }}
                                </td>

                                <td>
                                    {{ $application->rank->rank_name }}
                                </td>

                                <td>
                                    {{ Str::limit($application->content, 30) }}
                                </td>

                                @if($application->status)
                                    <td class="{{ $application->status->accepted ? 'text-success' : 'text-danger' }}">
                                        {{ $application->status->accepted ? 'Hired' : 'Rejected' }}
                                    </td>
                                @else
                                    <td class="text-warning">
                                        {{ __('Pending') }}
                                    </td>
                                @endif

                                <td class="{{ $application->user->online ? 'text-success' : 'text-danger' }}">
                                    {{ $application->user->online ? 'Online' : 'Offline' }}
                                </td>

                                <td>
                                    <div class="btn-group" role="group">
                                        @if(hasPermission('manage_staff_applications'))
                                            <a href="{{ route('staff-applications.show', $application) }}" class="ml-2">
                                                <x-elements.success-button tooltip-text="{{ __('Show application') }}">
                                                    <i class="fas fa-eye"></i>
                                                </x-elements.success-button>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $applications->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
