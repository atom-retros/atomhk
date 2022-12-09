<x-layout.app>
    @push('title', 'Emulator settings')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">Emulator settings</h3>

        <div class="row mb-4">
            <div class="ml-2" data-toggle="tooltip" data-placement="top" title="Enter part of the key you want to look for and it'll find every key matching your criteria.">
                <i class="far fa-question-circle"></i>
            </div>

           <div class="d-flex justify-content-between w-100">
               <div class="input-group">
                   <form action="{{ route('emulator-settings.search') }}" method="GET">
                       <div class="input-group col-12 col-lg-6">
                           <div class="d-flex">
                               <div class="form-outline">
                                   <input style="width: 300px;" type="search" name="criteria" placeholder="Enter your search criteria" class="form-control">
                               </div>

                               <button type="submit" class="ml-2 btn btn-primary">
                                   <i class="fas fa-search"></i>
                               </button>
                           </div>
                       </div>
                   </form>
               </div>

              <div class="col-12 col-lg-6 d-flex justify-content-end">
                  @if(hasPermission('manage_emulator_settings'))
                      <div class="d-flex" style="gap: 10px;">
                          <a href="{{ route('emulator-settings.create') }}">
                              <button class="btn btn-primary d-flex align-self-start">{{ __('Create emulator setting') }}</button>
                          </a>

                          <a href="{{ route('emulator-settings.update.rcon') }}">
                              <button class="btn btn-danger d-flex align-self-start">{{ __('Update settings (RCON)') }}</button>
                          </a>
                      </div>
                  @endif
              </div>
           </div>
        </div>

        <x-messages.flash-messages />

        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Emulator settings</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <td>{{ $setting->setting }}</td>
                                    <td>{{ $setting->value }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if(hasPermission('manage_emulator_settings'))
                                                <a href="{{ route('emulator-settings.edit', $setting->setting) }}">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                            @endif

                                            @if(hasPermission('manage_emulator_settings'))
                                                <form class="ml-2" id="deleteSettingForm" action="{{ route('emulator-settings.delete', $setting->setting) }}" method="POST" onSubmit="event.preventDefault(); return confirmDeleteSetting()">
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
                    {{ $settings->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script>
            function confirmDeleteSetting(e) {
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
                        document.querySelector('#deleteSettingForm').submit();
                    }
                })

                e.preventDefault();
            }
        </script>
    @endpush
</x-layout.app>