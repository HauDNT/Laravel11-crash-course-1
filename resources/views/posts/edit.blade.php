<x-layout>
    <a href="{{route('dashboard')}}" class="block mb-2 text-base text-blue-500">
        &larr;
        Go back to dashboard
    </a>

    <div class="card mb-4">
        <h2 class="title">Edit a post</h2>

        {{-- Session messages --}}
        @if (session("success"))
            <div class="mb-2">
                <x-flashMsg msg="{{session('success')}}" bg="bg-green-500"/>
            </div>
        @elseif (session("delete")) 
            <div class="mb-2">
                <x-flashMsg msg="{{session('delete')}}" bg="bg-red-500"/>
            </div>
        @endif

        <form action="{{ route("posts.update", $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            {{-- Post title --}}
            <div class="mb-4">
                <label for="title">Post title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="input
                @error("title") ring-offset-2 ring-red-500 @enderror">
                @error("title")
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post body --}}
            <div class="mb-4">
                <label for="body">Post content</label>
                <textarea name="body" rows="3" class="input
                @error("body") ring-offset-2 ring-red-500 @enderror">
                    {{ $post->body }}

                    @error("body")
                        <p class="error">{{ $message }}</p>
                    @enderror
                </textarea>            
            </div>

            {{-- Current cover photo if exists --}}
            @if ($post->image)
                <div class="h-64 rounded-md mb-4 w-2/4 object-cover overflow-hidden">
                    <label>Current cover photo</label>
                    <img src="{{ asset("storage/" . $post->image) }}" alt="" class="rounded max-h-50">
                </div>
            @endif

            {{-- Choose another image --}}
            <div class="mb-4">
                <label for="image">Choose another image</label>
                <input type="file" name="image" id="image">
                @error("image")
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>


            <button class="btn">Update</button>
        </form>
    </div>
</x-layout>