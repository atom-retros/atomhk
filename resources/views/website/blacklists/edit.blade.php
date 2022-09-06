<x-layout.app>
    @push('title', 'Edit website blacklist')
    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Edit website blacklist') }}</h3>

        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">{{ __('Edit website blacklist') }}</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('website-blacklist.update', $blacklist) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="ip_address">
                                                    <strong>{{ __('IP address') }}</strong>
                                                </label>

                                                <x-form.input name="ip_address" value="{{ $blacklist->ip_address }}" placeholder="{{ __('Enter an ip address') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="asn">
                                                    <strong>{{ __('ASN (optional)') }}</strong>
                                                </label>

                                                <x-form.input name="asn" value="{{ $blacklist->asn }}" placeholder="{{ __('Enter an ASN (optional)') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="blacklist_asn">
                                                    <strong>{{ __('Blacklist ASN') }}</strong>
                                                </label>

                                                <select class="form-control" name="blacklist_asn" id="blacklist_asn">
                                                    @if($blacklist->blacklist_asn)
                                                        <option value="1">{{ __('Yes') }}</option>
                                                        <option value="0">{{ __('No') }}</option>
                                                    @else
                                                        <option value="0">{{ __('No') }}</option>
                                                        <option value="1">{{ __('Yes') }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-elements.primary-button placement="right">
                                            {{ __('Update blacklist') }}
                                        </x-elements.primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>