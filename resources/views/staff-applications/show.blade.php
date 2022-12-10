<x-layout.app>
    @push('title', 'Edit user')
    <div class="container-fluid">
        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <p class="text-primary m-0 font-weight-bold">Manage Application</p>

                                <div class="d-flex">
                                    @if(!$application->status)
                                        <form action="{{ route('staff-applications.accept', $application) }}" method="POST">
                                            @method('PUT')
                                            @csrf

                                            <button class="btn btn-success">
                                                {{ __('Hire') }}
                                            </button>
                                        </form>

                                        <form action="{{ route('staff-applications.reject', $application) }}" method="POST">
                                            @method('PUT')
                                            @csrf

                                            <button class="btn btn-danger ml-2">
                                                {{ __('Reject') }}
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('staff-applications.reset', $application) }}" method="POST">
                                            @method('PUT')
                                            @csrf

                                            <button class="btn btn-warning ml-2">
                                                {{ __('Reset status') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="username">
                                                <strong>Applied by</strong>
                                            </label>

                                            <x-form.input name="by" value="{{ $application->user->username }}" :disabled="true"/>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="username">
                                                <strong>Rank applied for</strong>
                                            </label>

                                            <x-form.input name="rank" value="{{ $application->rank->rank_name }}" :disabled="true"/>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="username">
                                                <strong>Status</strong>
                                            </label>

                                            @if($application->status)
                                                <x-form.input name="status" value="{{ $application->status->accepted ? 'Hired' : 'Rejected' }}" :disabled="true" />
                                            @else
                                                <x-form.input name="status" value="Pending" :disabled="true" />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="username">
                                                <strong>Application</strong>
                                            </label>

                                            <div class="card">
                                                <div class="card-body">
                                                    {{ $application->content }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>