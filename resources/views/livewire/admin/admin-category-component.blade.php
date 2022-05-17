<div>
    <style>
        nav svg {
            height: 25px;
        }

        nav .hidden {
            display: block !important;
        }

    </style>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">All Categories</div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.addcategory') }}" class="btn btn-success pull-right">Add
                                    New</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</p>
                                    <th>Category</p>
                                    <th>slug</p>
                                    <th>Action</p>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td> {{ $category->id }} </td>>
                                        <td> {{ $category->name }} </td>>
                                        <td> {{ $category->slug }} </td>>
                                        <td>
                                            <a
                                                href="{{ route('admin.editcategory', ['category_slug' => $category->slug]) }}"><i
                                                    class="fa fa-edit fa-2x"></i></a>
                                            <a href="#"
                                                onclick="confirm('Are you sure, You want to DELETE this Category ?') || event.stopImmediatePropagation() "
                                                wire:click.prevent="deleteCategory({{ $category->id }})"
                                                style="margin-left: 10px"><i
                                                    class="fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
