<x-layout.app>
    @push('title', 'Edit website setting')
    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Edit website setting') }}</h3>

        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">{{ __('Edit website setting') }}</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('website-settings.update', $setting) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="key">
                                                    <strong>{{ __('Key') }}</strong>
                                                </label>

                                                <x-form.input name="key" value="{{ $setting->setting }}" placeholder="{{ __('Enter a key') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="value">
                                                    <strong>{{ __('Value') }}</strong>
                                                </label>

                                                <x-form.input name="value" value="{{ $setting->value }}" placeholder="{{ __('Enter a value') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label for="comment">
                                                    <strong>{{ __('Comment') }}</strong>
                                                </label>

                                                <x-form.input name="comment" value="{{ $setting->comment }}" placeholder="{{ __('Enter a comment') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-elements.primary-button placement="right">
                                            {{ __('Update setting') }}
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