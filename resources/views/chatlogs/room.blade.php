<x-layout.app>
    @push('title', 'Chatlogs')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">Chatlog Management</h3>

        <x-messages.flash-messages />

        <div class="row">
            <div class="ml-2" data-toggle="tooltip" data-placement="top" title="You can search for multiple users by seperating them by comma (eg. user1, user2, user3)">
                <i class="far fa-question-circle"></i>
            </div>

            <div class="input-group">
                <form action="{{ route('chatlogs.filter') }}" method="GET">
                    <div class="d-block d-md-flex">
                        <div class="col-12 col-lg-4">
                            <select class="form-control" name="sort_by">
                                <option value="word">Word</option>
                                <option value="users">Users</option>
                                <option value="rooms">Room</option>
                            </select>
                        </div>

                        <div class="input-group col-12 col-lg-10">
                            <div class="form-outline">
                                <input style="width: 300px;" type="search" name="search_input" placeholder="Enter your search criteria" class="form-control">
                            </div>

                            <button type="submit" class="ml-2 btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mb-4">
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Chatlogs List</p>
                </div>

                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Room</th>
                                <th>Message</th>
                                <th>Sent at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($chatlogs as $chatlog)
                                <tr>
                                    <td>{{ $chatlog->user->username ?? 'Unknown user' }}</td>
                                    <td>{{ $chatlog->room->name ?? 'Unknown room' }}</td>
                                    <td>{{ $chatlog->message }}</td>
                                    <td>{{ date('Y-m-d - h:m:s', $chatlog->timestamp) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        {{ $chatlogs->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>