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

                                                <input id="username" name="username" type="text" value="{{ $user->username }}" class="form-control" placeholder="Username">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="mail">
                                                    <strong>Email</strong>
                                                </label>

                                                <input id="mail" name="mail" type="email" value="{{ $user->mail }}" class="form-control" placeholder="Username">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="motto">
                                                    <strong>Motto</strong>
                                                </label>

                                                <input id="motto" name="motto" type="text" value="{{ $user->motto }}" class="form-control" placeholder="Motto">
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

                                                <input id="credits" name="credits" type="number" value="{{ $user->credits }}" class="form-control" placeholder="Username">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="duckets">
                                                    <strong>Duckets</strong>
                                                </label>

                                                <input id="duckets" name="duckets" type="number" value="{{ $user->currency('duckets') }}" class="form-control" placeholder="Username">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="diamonds">
                                                    <strong>Diamonds</strong>
                                                </label>

                                                <input id="diamonds" name="diamonds" type="number" value="{{ $user->currency('diamonds') }}" class="form-control" placeholder="Diamonds">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="points">
                                                    <strong>Points</strong>
                                                </label>

                                                <input id="points" name="points" type="number" value="{{ $user->currency('points') }}" class="form-control" placeholder="Points">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            Save
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