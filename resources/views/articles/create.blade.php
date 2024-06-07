<x-layout.app>
    @push('title', 'Create article')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">Post Article</h3>
        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Post Article</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('articles.store') }}" method="POST">
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="title">
                                                        <strong>Title</strong>
                                                    </label>

                                                    <x-form.input name="title" placeholder="Enter a article title"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="short_story">
                                                    <strong>Short Story</strong>
                                                </label>

                                                <x-form.input name="short_story" placeholder="Enter the article short story"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">
                                                    <strong>Image</strong>
                                                </label>

                                                <select class="form-control" name="image" id="image" class="form-control" onchange="previewImage(this.value);">
                                                    @foreach($images as $image)
                                                        <option value="{{ $image->getFilename() }}">{{ $image->getFilename() }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">
                                                    <strong>Upload your own image</strong>
                                                </label>

                                                <x-form.input name="custom_image" type="file" placeholder="Enter the article short story"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    <strong>Preview:&nbsp;</strong><br>
                                                </label>

                                                <div id="article-img" class="w-50 overflow-hidden" style="height: 170px; border-radius: 5px; background-size: cover;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="wysiwyg">
                                                    <strong>Content</strong>
                                                </label>

                                                <x-wysiwyg />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            Post Article
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

    <script>
        function previewImage(image) {
            $('#article-img').css("background", "url('/assets/images/articles/" + image + "') center");
        }
    </script>
</x-layout.app>
