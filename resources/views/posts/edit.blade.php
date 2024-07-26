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

        <form action="{{ route("posts.update", $post) }}" method="POST">
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
                <textarea name="body" rows="10" class="input
                @error("body") ring-offset-2 ring-red-500 @enderror">
                    {{ $post->body }}

                    @error("body")
                        <p class="error">{{ $message }}</p>
                    @enderror
                </textarea>            
            </div>

            <button class="btn">Update</button>
        </form>
    </div>
</x-layout>