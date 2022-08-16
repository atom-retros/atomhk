<x-layout.app>
    @push('title', 'Wordfilter')

    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h3 class="text-dark mb-4">Wordfilter Management</h3>

            @if(hasPermission(auth()->user(), 'write_article'))
                <a href="{{ route('wordfilter.create') }}">
                    <button class="btn btn-primary d-flex align-self-start">{{ __('Create filter') }}</button>
                </a>
            @endif
        </div>

        <x-messages.flash-messages />

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Wordfilter list</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>Word</th>
                            <th>Replacement</th>
                            <th>Hide</th>
                            <th>Report</th>
                            <th>Mute</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($words as $word)
                                <tr>
                                    <td>{{ $word->key }}</td>
                                    <td>{{ $word->replacement }}</td>
                                    <td>{{ $word->hide ? 'Yes' : 'No' }}</td>
                                    <td>{{ $word->report ? 'Yes' : 'No' }}</td>
                                    <td>{{ $word->mute ? 'Yes' : 'No' }}</td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission(auth()->user(), 'manage_wordfilter'))
                                                <a href="{{ route('wordfilter.edit', $word->key) }}">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                            @endif

                                            @if(hasPermission(auth()->user(), 'manage_wordfilter'))
                                                <form class="ml-2" action="{{ route('wordfilter.destroy', $word->key) }}" method="POST">
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
                    {{ $words->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>