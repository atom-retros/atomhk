<x-layout.app>
    @push('title', 'Users')

    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h3 class="text-dark mb-4">User Management</h3>

            @if(hasPermission(auth()->user(), 'write_article'))
                <a href="{{ route('articles.create') }}">
                    <button class="btn btn-primary d-flex align-self-start">{{ __('Create article') }}</button>
                </a>
            @endif
        </div>

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
                            <th>Slug</th>
                            <th>Title</th>
                            <th>Shorty story</th>
                            <th>Full story</th>
                            <th>image</th>
                            <th>Author</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->slug }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ Str::limit($article->short_story, 30) }}</td>
                                    <td>{{ Str::limit($article->full_story, 30) }}</td>
                                    <td>{{ $article->image }}</td>
                                    <td>{{ $article->user?->username }}</td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission(auth()->user(), 'edit_article'))
                                                <a href="{{ route('articles.edit', $article) }}">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                            @endif

                                            @if(hasPermission(auth()->user(), 'delete_article'))
                                                <form class="ml-2" action="{{ route('articles.destroy', $article) }}" method="POST">
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
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
