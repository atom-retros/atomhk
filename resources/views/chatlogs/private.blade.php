<x-layout.app>
    @push('title', 'Private Chatlogs')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">Private chatalogs Management</h3>

        <x-messages.flash-messages />

        <div class="row">
            <div class="input-group">
                <form action="{{ route('chatlogs.private.filter') }}" method="GET">
                    <div class="d-block d-md-flex">
                        <div class="col-12 col-lg-4">
                            <select class="form-control" name="sort_by">
                                <option value="word">Word</option>
                                <option value="sender">Sender</option>
                                <option value="receiver">Receiver</option>
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
                    <p class="text-primary m-0 font-weight-bold">Private chatalogs</p>
                </div>

                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Receiver</th>
                                <th>Message</th>
                                <th>Sent at1</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($chatlogs as $chatlog)
                                <tr>
                                    <td>{{ $chatlog->sender->username ?? 'Unknown user' }}</td>
                                    <td>{{ $chatlog->receiver->username ?? 'Unknown user' }}</td>
                                    <td>{{ $chatlog?->message }}</td>
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