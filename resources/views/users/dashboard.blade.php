<x-layout>
    {{-- Create post form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>

        {{-- Session messages --}}
        @if (session("success"))
            <div class="mb-2">
                <x-flashMsg msg="{{session('success')}}" bg="bg-green-500"/>
            </div>
        @endif

        <form action="{{ route("posts.store") }}" method="POST">
            @csrf

            {{-- Post title --}}
            <div class="mb-4">
                <label for="title">Post title</label>
                <input type="text" name="title" value="{{ old("title") }}" class="input
                @error("title") ring-offset-2 ring-red-500 @enderror">
                @error("title")
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post body --}}
            <div class="mb-4">
                <label for="body">Post content</label>
                <textarea name="body" rows="5" class="input
                @error("body") ring-offset-2 ring-red-500 @enderror">
                    {{ old("body") }}

                    @error("body")
                        <p class="error">{{ $message }}</p>
                    @enderror
                </textarea>            
            </div>

            <button class="btn">Create</button>
        </form>
    </div>
</x-layout>