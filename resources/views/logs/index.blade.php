<x-layout.app>
    @push('title', 'Acitivty logs')

    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h3 class="text-dark mb-4">Activity logs</h3>
        </div>

        <x-messages.flash-messages />

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Activity logs</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th>Caused by</th>
                            <th>Caused on</th>
                            <th>Properties</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->causer->username }}</td>
                                    <td>{{ $log->subject_type }}</td>
                                    <td>{{ Str::limit($log->properties, 50) }}</td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission(auth()->user(), 'view_activity_logs'))
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#logModal-{{ $log->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="logModal-{{ $log->id }}" tabindex="-1" role="dialog" aria-labelledby="logModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="logModalLabel">Activity log details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($log->properties as $key => $value)
                                                    <strong>{{ Str::replace('attributes', 'new', $key) }}</strong><br/>
                                                    @if(is_array($value))
                                                        <ul>
                                                            @foreach($value as $k => $v)
                                                                <li>
                                                                    <strong>{{ $k }}</strong> {{ $v }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    {{ $logs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
