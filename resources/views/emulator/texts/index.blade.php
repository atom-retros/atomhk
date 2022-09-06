<x-layout.app>
    @push('title', __('Emulator Texts'))

    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Emulator texts') }}</h3>

        <div class="row mb-4">
            <div class="ml-2" data-toggle="tooltip" data-placement="top" title="Enter part of the key you want to look for and it'll find every key matching your criteria.">
                <i class="far fa-question-circle"></i>
            </div>

           <div class="d-flex justify-content-between w-100">
               <div class="input-group">
                   <form action="{{ route('emulator-texts.search') }}" method="GET">
                       <div class="input-group col-12 col-lg-6">
                           <div class="d-flex">
                               <div class="form-outline">
                                   <input style="width: 300px;" type="search" name="criteria" placeholder="Enter your search criteria" class="form-control">
                               </div>

                               <x-elements.primary-button classes="ml-2">
                                   <i class="fas fa-search"></i>
                               </x-elements.primary-button>
                           </div>
                       </div>
                   </form>
               </div>

              <div class="col-12 col-lg-6 d-flex justify-content-end">
                  @if(hasPermission(auth()->user(), 'manage_emulator_texts'))
                      <div class="d-flex" style="gap: 10px;">
                          <a href="{{ route('emulator-texts.create') }}">
                              <button class="btn btn-primary d-flex align-self-start">{{ __('Create emulator texts') }}</button>
                          </a>

                          <form action="{{ route('emulator-texts.update.rcon') }}" method="POST">
                              @csrf

                              <x-elements.danger-button>
                                  {{ __('Update texts (RCON)') }}
                              </x-elements.danger-button>
                          </form>
                      </div>
                  @endif
              </div>
           </div>
        </div>

        <x-messages.flash-messages />

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">{{ __('Emulator Texts') }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('Key') }}</th>
                            <th>{{ __('Value') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($texts as $text)
                                <tr>
                                    <td>{{ $text->text }}</td>
                                    <td>{{ $text->value }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission(auth()->user(), 'manage_emulator_texts'))
                                                <a href="{{ route('emulator-texts.edit', $text->text) }}">
                                                    <x-elements.primary-button>
                                                        <i class="fa fa-pencil"></i>
                                                    </x-elements.primary-button>
                                                </a>
                                            @endif

                                            @if(hasPermission(auth()->user(), 'manage_emulator_texts'))
                                                <form class="ml-2" id="deleteTextsForm" action="{{ route('emulator-texts.delete', $text->text) }}" method="POST" onSubmit="event.preventDefault(); return confirmDeleteText()">
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
                    {{ $texts->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script>
            function confirmDeleteText(e) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelector('#deleteTextsForm').submit();
                    }
                })

                e.preventDefault();
            }
        </script>
    @endpush
</x-layout.app>