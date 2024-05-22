@extends('layout.main')

@section('content')
    <div class="btn-group btn-group mt-3 float-right" role="group">
        @can('viewAny', App\Models\Category::class)
            <a href="{{ route('categories.index') }}" class="btn btn-primary" title="Show All Category">
                <span class="fa fa-list" aria-hidden="true"></span>
            </a>
        @endcan
        @can('create', App\Models\Category::class)
            <a href="{{ route('categories.create') }}" class="btn btn-success" title="Create New Category">
                <span class="fa fa-plus" aria-hidden="true"></span>
            </a>
        @endcan
        @can('update', $category)
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary" title="Edit Category">
                <span class="fa fa-edit" aria-hidden="true"></span>
            </a>
        @endcan
        @can('delete', $category)
            <button type="submit" class="btn btn-danger" title="Delete User" data-toggle="modal" data-target="#delete">
                <span class="fa fa-trash" aria-hidden="true"></span>
            </button>
        @endcan
    </div>
    <p class="clearfix"></p>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-title">
                <h4>{{ $category->name }}</h4>
            </div>
        </div>
        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>Image</dt>
                <dd>
                    <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width:80px;height:80px">
                </dd>
                <dt>Category Name</dt>
                <dd>{{ $category->name }}</dd>
                <dt>Description</dt>
                <dd>{{ $category->description }}</dd>
                <dt>Status</dt>
                <dd>{{ $category->status }}</dd>

            </dl>
        </div>
    </div>
    @can('delete', $category)
        <div class="modal fade in" id="delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p> Delete {{ $category->name }} ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <form method="POST" action="{!! route('categories.destroy', $category->id) !!}" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            @csrf
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
