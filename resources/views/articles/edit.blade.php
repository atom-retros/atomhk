<x-layout.app>
    @push('title', 'Edit article')

    <div class="container-fluid">
        <h3 class="text-dark mb-4">Edit Article</h3>
        <x-messages.flash-messages />

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Edit Article</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('articles.update', $article) }}" method="POST">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">
                                                    <strong>Title</strong>
                                                </label>

                                                <input class="form-control" type="text" name="title" value="{{ $article->title }}" placeholder="{{ __('Enter an article title') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="short_story">
                                                    <strong>Short Story</strong>
                                                </label>

                                                <input class="form-control" type="text" name="short_story" value="{{ $article->short_story }}" placeholder="Enter the article short story">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">
                                                    <strong>Image</strong>
                                                </label>

                                                <select class="form-control" name="image" id="image" class="form-control" onkeypress="changeImage(this.value);" onchange="changeImage(this.value);">
                                                    <option value="{{ substr($article->image, strrpos($article->image, '/') + 1) }}">
                                                        {{ substr($article->image, strrpos($article->image, '/') + 1) }}
                                                    </option>

                                                    @foreach($images as $image)
                                                        <option value="{{ $image->getFilename() }}">{{ $image->getFilename() }}</option>
                                                    @endforeach
                                                </select>
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

                                                <x-wysiwyg :placeholder="$article->full_story"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            Update Article
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
    function changeImage(image) {
        $('#article-img').css("background", "url('/assets/images/articles/" + image + "') center");
    }
</script>
</x-layout.app>
