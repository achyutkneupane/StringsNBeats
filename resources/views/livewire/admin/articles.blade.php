<div>
    @section('title',$title)
    <div class="pt-4 content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center">
                            <div class="card col-lg-10">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">All Articles</h5>
                                        <a class="px-3 py-2 btn btn-success" href="{{ route('adminAddArticles') }}">+ Add</a>
                                    </div>
                                    <p class="card-text">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                              <tr class="text-center">
                                                <th scope="col">ID</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Slug</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Writer</th>
                                                <th scope="col" class="text-right">Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody class="user-select-none">
                                                @if($articles->count() > 0)
                                                @foreach ($articles as $article)
                                                <tr>
                                                    <th scope="row">{{ $article->id }}</th>
                                                    <td>
                                                        {{ $article->title }}
                                                    </td>
                                                    <td>
                                                        {{ $article->slug }}
                                                    </td>
                                                    <td>
                                                        {{ $article->category->title }}
                                                    </td>
                                                    <td>
                                                        {{ ucwords($article->status) }}
                                                    </td>
                                                    <td>
                                                        {{ ucwords($article->writer->name) }}
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="{{ route('adminEditArticles',$article->id) }}" class="btn btn-warning">Edit</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        No articles till now. Click <b>+Add</b> to add new.
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
@endpush
@push('scripts')
@endpush