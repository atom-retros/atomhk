<x-layout.app>
    @push('title', 'Create article')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">Add word</h3>
        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Add word</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('wordfilter.store') }}" method="POST">
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="title">
                                                    <strong>Word</strong>
                                                </label>

                                                <input class="form-control" type="text" name="key" placeholder="{{ __('Enter a word') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="short_story">
                                                    <strong>Replacement</strong>
                                                </label>

                                                <input class="form-control" type="text" name="replacement" placeholder="Enter a replacement">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="hide">
                                                    <strong>Hide</strong>
                                                </label>

                                                <select name="hide" id="hide" class="form-control">
                                                    <option value="0">{{ __('No') }}</option>
                                                    <option value="1">{{ __('Yes') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="report">
                                                    <strong>Report</strong>
                                                </label>

                                                <select name="report" id="report" class="form-control">
                                                    <option value="0">{{ __('No') }}</option>
                                                    <option value="1">{{ __('Yes') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="mute">
                                                    <strong>Mute</strong>
                                                </label>

                                                <select name="mute" id="mute" class="form-control">
                                                    <option value="0">{{ __('No') }}</option>
                                                    <option value="1">{{ __('Yes') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            Add word
                                        </button>
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