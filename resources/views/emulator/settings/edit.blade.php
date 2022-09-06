<x-layout.app>
    @push('title', 'Edit emulator setting')
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Edit Emulator Setting</h3>

        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Edit Emulator Setting</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('emulator-settings.update', $setting->setting) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="key">
                                                    <strong>Key</strong>
                                                </label>

                                                <x-form.input name="setting" value="{{ $setting->setting }}" placeholder="Enter a key"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="value">
                                                    <strong>Value</strong>
                                                </label>

                                                <x-form.input name="value" value="{{ $setting->value }}" placeholder="Enter a value"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-elements.primary-button placement="right">
                                            Update setting
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