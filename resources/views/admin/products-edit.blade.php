@extends('layouts.dashboard')
@section('content')
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('admin.products.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <div class="mb-4">
                                <label for="name" class="block mb-2 text-sm font-medium leading-5 text-gray-700">Name</label>
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                <input type="text" id="name" name="name" value="{{ $product->name }}"
                                       class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                                       required>
                            </div>
                            <div class="mb-4">
                                <label for="price"
                                       class="block mb-2 text-sm font-medium leading-5 text-gray-700">Price</label>
                                @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                                <input type="number" id="price" name="price" value="{{ $product->price }}"
                                       class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                                       required>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block mb-2 text-sm font-medium leading-5 text-gray-700">Description</label>
                                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                                <input type="text" id="description" name="description" value="{{ $product->description }}"
                                       class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                                       required>
                            </div>
                            <div class="mb-4 flex w-full flex-wrap mt-4 content-center justify-between align-middle">
                                <div>
                                    <label for="image"
                                           class="block mb-2 text-sm font-medium leading-5 text-gray-700">Image</label>
                                    @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
                                    <input type="file" id="image" name="image"
                                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500">
                                </div>
                                <div>
                                    <img id="image-preview" src="{{ asset($product->image) }}" alt="Image Preview" style="max-width: 400px;">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="category"
                                       class="block mb-2 text-sm font-medium leading-5 text-gray-700">Category</label>
                                @error('category') <span class="text-red-500">{{ $message }}</span> @enderror
                                <select name="category" id="category" required
                                        class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" @if($product->category->first()->id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="addons[]"
                                       class="block mb-2 text-sm font-medium leading-5 text-gray-700">Addons</label>
                                <select class="addons w-full" name="addons[]" multiple="multiple">
                                    <option value="" disabled>Select Addons</option>
                                    @foreach(\App\Models\Addons::all() as $addon)
                                        <option value="{{ $addon->id }}" @if(in_array($addon->id, $product->addons->pluck('id')->toArray())) selected @endif>{{ $addon->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script>
        $(document).ready(function () {
            $('#image').change(function () {
                var input = this;
                var imgPreview = $('#image-preview')[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        imgPreview.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    imgPreview.src = '';
                }
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#file-upload').change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('.addons').select2();
        });
    </script>
@endsection
