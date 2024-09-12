<x-layout.app>
    @push('title', 'Edit item')

    <div class="container-fluid">
        <x-messages.flash-messages/>

        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex">
                                <p class="text-primary m-0 font-weight-bold">{{ __('Edit :item', ['item' => $item->catalog_name]) }}</p>
                                <img
                                    style="max-width: 30px; max-height: 30px;"
                                    class="ml-2"
                                    src="{{ asset(setting('catalog_item_icons_path') . '/' . properCatalogItemName($item->catalog_name) . '_icon.png') }}"
                                    alt="Missing icon">
                            </div>
                            <div class="card-body">
                                <form action="{{ route('catalog-pages.update', $item) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="parent_id">
                                                    <strong>{{ __('Item ID') }}</strong>
                                                </label>

                                                <x-form.input name="item_ids" type="number"
                                                              value="{{ $item->item_ids }}"
                                                              placeholder="{{ __('Enter an item ID') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="page_id">
                                                    <strong>Catalog page</strong>
                                                </label>

                                                <select name="" id="" class="form-control form-select">
                                                    <option value="{{ $item->catalogPage->id }}" selected>
                                                        {{ $item->catalogPage->caption }}
                                                    </option>

                                                    @foreach($pages as $page)
                                                        <option value="{{ $page->id }}">{{ $page->caption }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-elements.primary-button placement="right">
                                            {{ __('Update item') }}
                                        </x-elements.primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">{{ __('Item base') }}</p>
                            </div>

                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(!empty($furnidata))
                <div class="col-lg-6 mt-4">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 font-weight-bold">{{ __('Edit furniture data for :item', ['item' => $item->catalog_name]) }}</p>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('catalog-pages.update', $item) }}" method="POST">
                                        @method('PUT')
                                        @csrf

                                        <textarea name="furniture_data" id="furniture_data" class="form-control"
                                                  rows="10">{{ json_encode($furnidata['furni'], JSON_PRETTY_PRINT) }}</textarea>

                                        <div class="form-group mt-2">
                                            <x-elements.primary-button placement="right">
                                                {{ __('Update furnidata') }}
                                            </x-elements.primary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout.app>
