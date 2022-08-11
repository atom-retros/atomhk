<x-layout.app>
    @push('title', 'Dashboard')

    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                <span>users registered</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{ DB::table('users')->count() }}</span>
                            </div>
                        </div>

                        <div class="col-auto">
                            <img src="assets/images/signup_icon.gif">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                                <span>Users online</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{ DB::table('users')->where('online', '1')->count() }}</span>
                            </div>
                        </div>

                        <div class="col-auto">
                            <img src="assets/images/signup_icon.gif">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-warning py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1">
                                <span>Active rooms</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{ DB::table('rooms')->where('users', '>', '0')->count() }}</span>
                            </div>
                        </div>

                        <div class="col-auto">
                            <img src="assets/images/signup_icon.gif">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-duckets py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-duckets font-weight-bold text-xs mb-1">
                                <span>Items in the catalogue</span>
                            </div>

                            <div class="text-dark font-weight-bold h5 mb-0">
                                <span>{{ DB::table('catalog_items')->count() }}</span>
                            </div>
                        </div>

                        <div class="col-auto">
                            <img src="assets/images/signup_icon.gif">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-3">
        <div class="card col-12">
            <div class="card-body">
                <div class="d-flex justify-content-center w-100">
                    <img src="{{ asset('assets/images/kasja_atom_logo.png') }}" alt="">
                </div>
                <br><br>

                <p>
                    Hi {{ auth()->user()->username }} 👋
                </p>

                <p>
                    Welcome to Atom Housekeeping. Atom housekeeping is designed to provide a good user experience for you to manage various aspects of the hotel that you're staff on.
                </p>

                <p>
                    <strong>With great power comes great responsibility</strong><br>
                    The housekeeping is not to be abused, and every action made inside of the housekeeping will be logged and closely monetized - If you're caught abusing the housekeeping, you will be instantly demoted from your position and potentially banned from the hotel.
                </p>

                <p>
                    <strong>Thank you</strong> for using the housekeeping with care and stay awesome!
                </p>
            </div>
        </div>
    </div>
</x-layout.app>