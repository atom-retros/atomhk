<x-layout.app>
    @push('title', __('Website whitelist'))

    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Website whitelist') }}</h3>

        <div class="row mb-4">
            <div class="ml-2" data-toggle="tooltip" data-placement="top" title="Enter the whole or a part of the IP you want to look for and it'll find every IP matching your criteria.">
                <i class="far fa-question-circle"></i>
            </div>

           <div class="d-flex justify-content-between w-100">
               <div class="input-group">
                   <form action="{{ route('website-whitelist.search') }}" method="GET">
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
                  @if(hasPermission(auth()->user(), 'manage_website_whitelists'))
                      <div class="d-flex" style="gap: 10px;">
                          <a href="{{ route('website-whitelist.create') }}">
                              <button class="btn btn-primary d-flex align-self-start">{{ __('Create website whitelist') }}</button>
                          </a>
                      </div>
                  @endif
              </div>
           </div>
        </div>

        <x-messages.flash-messages />

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">{{ __('Website whitelist') }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('Ip address') }}</th>
                            <th>{{ __('ASN') }}</th>
                            <th>{{ __('ASN blacklisted') }}</th>
                            <th>{{ __('Blacklisted at') }}</th>
                            <th>{{ __('Updated at') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($whitelists as $whitelist)
                                <tr>
                                    <td>{{ $whitelist->ip_address }}</td>
                                    <td>{{ $whitelist->asn ?? __('N/A') }}</td>
                                    <td>{{ $whitelist->whitelist_asn ? __('Yes') : __('No') }}</td>
                                    <td>{{ $whitelist->created_at }}</td>
                                    <td>{{ $whitelist->updated_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission(auth()->user(), 'manage_website_whitelists'))
                                                <a href="{{ route('website-whitelist.edit', $whitelist) }}">
                                                    <x-elements.primary-button>
                                                        <i class="fa fa-pencil"></i>
                                                    </x-elements.primary-button>
                                                </a>
                                            @endif

                                            @if(hasPermission(auth()->user(), 'manage_website_whitelists'))
                                                <form class="ml-2" id="deleteWhitelistForm" action="{{ route('website-whitelist.destroy', $whitelist) }}" method="POST" onSubmit="event.preventDefault(); return confirmDeleteWhitelist()">
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
                    {{ $whitelists->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script>
            function confirmDeleteWhitelist(e) {
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
                        document.querySelector('#deleteWhitelistForm').submit();
                    }
                })

                e.preventDefault();
            }
        </script>
    @endpush
</x-layout.app>