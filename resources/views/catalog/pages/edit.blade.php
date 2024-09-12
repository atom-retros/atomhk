<x-layout.app>
    @push('title', sprintf('Edit %s', $page->caption))

    <div class="container-fluid">
        <x-messages.flash-messages/>

        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">{{ __('Edit catalog page') }}</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('catalog-pages.update', $page) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="parent_id">
                                                    <strong>{{ __('Parent Id') }}</strong>
                                                </label>

                                                <x-form.input name="parent_id" type="number"
                                                              value="{{ $page->parent_id }}"
                                                              placeholder="{{ __('Enter a parent_id') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="caption">
                                                    <strong>Caption</strong>
                                                </label>

                                                <x-form.input name="caption" type="text" value="{{ $page->caption }}"
                                                              placeholder="{{ __('Enter a caption') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="visible">
                                                    <strong>{{ __('Visible') }}</strong>
                                                </label>

                                                <select name="visible" id="visible" class="form-control">
                                                    @if($page->visible)
                                                        <option value="1">{{ __('Yes') }}</option>
                                                        <option value="0">{{ __('No') }}</option>
                                                    @else
                                                        <option value="0">{{ __('No') }}</option>
                                                        <option value="1">{{ __('Yes') }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="enabled">
                                                    <strong>{{ __('Enabled') }}</strong>
                                                </label>

                                                <select name="enabled" id="enabled" class="form-control">
                                                    @if($page->enabled)
                                                        <option value="1">{{ __('Yes') }}</option>
                                                        <option value="0">{{ __('No') }}</option>
                                                    @else
                                                        <option value="0">{{ __('No') }}</option>
                                                        <option value="1">{{ __('Yes') }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="page_layout">
                                                    <strong>Page layout</strong>
                                                </label>

                                                <select name="page_layout" id="page_layout" class="form-control">
                                                    <option
                                                        value="{{ $page->page_layout }}">{{ $page->page_layout }}</option>
                                                    <option value="default_3x3">default_3x3</option>
                                                    <option value="club_buy">club_buy</option>
                                                    <option value="club_gift">club_gift</option>
                                                    <option value="frontpage">frontpage</option>
                                                    <option value="spaces">spaces</option>
                                                    <option value="recycler">recycler</option>
                                                    <option value="recycler_info">recycler_info</option>
                                                    <option value="recycler_prizes">recycler_prizes</option>
                                                    <option value="trophies">trophies</option>
                                                    <option value="plasto">plasto</option>
                                                    <option value="marketplace">marketplace</option>
                                                    <option value="marketplace_own_items">marketplace_own_items</option>
                                                    <option value="spaces_new">spaces_new</option>
                                                    <option value="soundmachine">soundmachine</option>
                                                    <option value="guilds">guilds</option>
                                                    <option value="guild_furni">guild_furni</option>
                                                    <option value="info_duckets">info_duckets</option>
                                                    <option value="info_rentables">info_rentables</option>
                                                    <option value="info_pets">info_pets</option>
                                                    <option value="roomads">roomads</option>
                                                    <option value="single_bundle">single_bundle</option>
                                                    <option value="sold_ltd_items">sold_ltd_items</option>
                                                    <option value="badge_display">badge_display</option>
                                                    <option value="bots">bots</option>
                                                    <option value="pets">pets</option>
                                                    <option value="pets2">pets2</option>
                                                    <option value="pets3">pets3</option>
                                                    <option value="productpage1">productpage1</option>
                                                    <option value="room_bundle">room_bundle</option>
                                                    <option value="recent_purchases">recent_purchases</option>
                                                    <option value="default_3x3_color_grouping">
                                                        default_3x3_color_grouping
                                                    </option>
                                                    <option value="guild_forum">guild_forum</option>
                                                    <option value="vip_buy">vip_buy</option>
                                                    <option value="info_loyalty">info_loyalty</option>
                                                    <option value="loyalty_vip_buy">loyalty_vip_buy</option>
                                                    <option value="collectibles">collectibles</option>
                                                    <option value="petcustomization">petcustomization</option>
                                                    <option value="frontpage_featured">frontpage_featured</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="icon_image">
                                                    <strong>{{ __('Icon image') }}</strong>
                                                </label>

                                                <x-form.input name="icon_image" type="number"
                                                              value="{{ $page->icon_image }}"
                                                              placeholder="{{ __('Enter an icon image') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="min_rank">
                                                    <strong>{{ __('Minimum rank') }}</strong>
                                                </label>

                                                <x-form.input name="min_rank" value="1" type="number"
                                                              value="{{ $page->min_rank }}"
                                                              placeholder="{{ __('Enter a minimum rank') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="order_num">
                                                    <strong>{{ __('Order number') }}</strong>
                                                </label>

                                                <x-form.input name="order_num" value="1" type="number"
                                                              value="{{ $page->order_num }}"
                                                              placeholder="{{ __('Enter a caption') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="page_headline">
                                                    <strong>{{ __('Page headline') }}</strong>
                                                </label>

                                                <x-form.input name="page_headline" value="{{ $page->page_headline }}"
                                                              placeholder="{{ __('Enter a page headline') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="page_teaser">
                                                    <strong>{{ __('Page teaser') }}</strong>
                                                </label>

                                                <x-form.input name="page_teaser" value="{{ $page->page_teaser }}"
                                                              placeholder="{{ __('Enter a page teaser') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="page_text1">
                                                    <strong>{{ __('Page text 1') }}</strong>
                                                </label>

                                                <x-form.input name="page_text1" value="{{ $page->page_text1 }}"
                                                              placeholder="{{ __('Enter page text 1') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="page_text2">
                                                    <strong>{{ __('Page text 2') }}</strong>
                                                </label>

                                                <x-form.input name="page_text2" value="{{ $page->page_text2 }}"
                                                              placeholder="{{ __('Enter page text 2') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="wysiwyg">
                                                    <strong>{{ __('Page text details') }}</strong>
                                                </label>

                                                <textarea style="min-height: 400px;" id="wysiwyg"
                                                          name="page_text_details">
                                                    {!! $page->page_text_details !!}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <x-elements.primary-button placement="right">
                                            {{ __('Update page') }}
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
                                <p class="text-primary m-0 font-weight-bold">{{ __('Catalog items') }}</p>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                     style="overflow-y: auto; max-height: 600px;"
                                     aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Icon') }}</th>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Item IDs') }}</th>
                                            <th>{{ __('Catalog name') }}</th>
                                            <th>Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($page->items as $item)
                                            <tr>
                                                <td>
                                                    <img
                                                        style="max-width: 30px; max-height: 30px;"
                                                        src="{{ asset(setting('catalog_item_icons_path') . '/' . properCatalogItemName($item->catalog_name) . '_icon.png') }}"
                                                        alt="Missing icon">
                                                </td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->item_ids }}</td>
                                                <td>{{ $item->catalog_name }}</td>

                                                <td>
                                                    <div class="btn-group" role="group">
                                                        @if(hasPermission('manage_catalog_pages'))
                                                            <a href="{{ route('catalog-pages.items.edit', $item) }}">
                                                                <x-elements.primary-button
                                                                    tooltip-text="{{ __('Edit item') }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </x-elements.primary-button>
                                                            </a>
                                                        @endif

                                                        @if(hasPermission('delete_catalog_pages'))
                                                            <form class="ml-2" id="deletePageForm"
                                                                  action="{{ route('catalog-pages.delete', $item) }}"
                                                                  method="POST"
                                                                  onSubmit="return confirm('Are you sure you want to delete this catalog page?');">
                                                                @method('DELETE')
                                                                @csrf

                                                                <x-elements.danger-button tooltip-text="Delete item">
                                                                    <i class="fas fa-trash"></i>
                                                                </x-elements.danger-button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script src="https://cdn.tiny.cloud/1/{{ setting('tinymce_api_key') }}/tinymce/5/tinymce.min.js"
                referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: '#wysiwyg',
                plugins: [
                    "autosave advlist link lists charmap preview anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime",
                    "table directionality  paste textcolor colorpicker image "
                ],
                toolbar: "undo redo | fontselect fontsizeselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent link table | image | preview ",
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                protect: [
                    /\<\/?(if|endif)\>/g,
                    /\<xsl\:[^>]+\>/g,
                    /<\?php.*?\?>/g
                ],
            });
        </script>
    @endpush
</x-layout.app>
