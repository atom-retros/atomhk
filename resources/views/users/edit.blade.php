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
                                <form action="{{ route('users.update', $user) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="username">
                                                    <strong>Username</strong>
                                                </label>

                                                <x-form.input name="username" value="{{ $user->username }}" placeholder="Enter a username"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="mail">
                                                    <strong>Email</strong>
                                                </label>

                                                <x-form.input name="mail" type="email" value="{{ $user->mail }}" placeholder="Enter an email"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="motto">
                                                    <strong>Motto</strong>
                                                </label>

                                                <x-form.input name="motto" value="{{ $user->motto }}" placeholder="Enter a motto"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="rank">
                                                    <strong>Rank</strong>
                                                </label>

                                                <select name="rank" id="rank" class="form-control">
                                                    <option value="{{ $user->permission->id }}">{{ $user->permission->rank_name }} (current)</option>

                                                    @foreach($ranks as $rank)
                                                        <option value="{{ $rank->id }}">{{ $rank->rank_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="credits">
                                                    <strong>Credits</strong>
                                                </label>

                                                <x-form.input name="credits" type="number" value="{{ $user->credits }}" placeholder="Enter a credit amount"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="duckets">
                                                    <strong>Duckets</strong>
                                                </label>

                                                <x-form.input name="duckets" type="number" value="{{ $user->currency('duckets') }}" placeholder="Enter a ducket amount"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="diamonds">
                                                    <strong>Diamonds</strong>
                                                </label>

                                                <x-form.input name="diamonds" type="number" value="{{ $user->currency('diamonds') }}" placeholder="Enter a diamond amount"/>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="points">
                                                    <strong>Points</strong>
                                                </label>

                                                <x-form.input name="points" type="number" value="{{ $user->currency('points') }}" placeholder="Enter a point amount"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-elements.primary-button placement="right">
                                            Update user
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