<x-layout.app>
    @push('title', 'Wordfilter')

    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h3 class="text-dark mb-4">{{ __('Wordfilter Management') }}</h3>

            @if(hasPermission('manage_wordfilter'))
                <div class="d-flex" style="gap: 10px;">
                    <a href="{{ route('wordfilter.create') }}">
                        <x-elements.primary-button>
                            {{ __('Add word') }}
                        </x-elements.primary-button>
                    </a>

                    <form action="{{ route('wordfilter.update-rcon') }}" method="POST">
                        @csrf

                        <x-elements.danger-button>
                            {{ __('Update wordfilter (RCON)') }}
                        </x-elements.danger-button>
                    </form>
                </div>
            @endif
        </div>

        <x-messages.flash-messages />

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">{{ __('Wordfilter list') }}</p>
            </div>

            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('Word') }}</th>
                            <th>{{ __('Replacement') }}</th>
                            <th>{{ __('Hide') }}</th>
                            <th>{{ __('Report') }}</th>
                            <th>{{ __('Mute') }}</th>
                            <th>{{ __('Manage') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($words as $word)
                                <tr>
                                    <td>{{ $word->key }}</td>
                                    <td>{{ $word->replacement }}</td>
                                    <td>{{ $word->hide ? __('Yes') : __('No') }}</td>
                                    <td>{{ $word->report ? __('Yes') : __('No') }}</td>
                                    <td>{{ $word->mute ? __('Yes') : __('No') }}</td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission('manage_wordfilter'))
                                                <a href="{{ route('wordfilter.edit', $word->key) }}">
                                                    <x-elements.primary-button type="button">
                                                        <i class="fa fa-pencil"></i>
                                                    </x-elements.primary-button>
                                                </a>
                                            @endif

                                            @if(hasPermission('manage_wordfilter'))
                                                <form class="ml-2" action="{{ route('wordfilter.destroy', $word->key) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf

                                                    <x-elements.danger-button>
                                                        <i class="fa fa-trash"></i>
                                                    </x-elements.danger-button>
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
                    {{ $words->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.app>