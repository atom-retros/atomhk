<x-layout.app>
    @push('title', 'Edit user')
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Edit User</h3>

        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Edit User</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('users.password.update', $user) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="username">
                                                    <strong>{{ __('New Password') }}</strong>
                                                </label>

                                                <x-form.input type="password" name="password" placeholder="{{ __('Enter a new password') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="username">
                                                    <strong>{{ __('Confirm Password') }}</strong>
                                                </label>

                                                <x-form.input type="password" name="password_confirmation" placeholder="{{ __('Confirm the new password') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-elements.primary-button placement="right">
                                            Update password
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