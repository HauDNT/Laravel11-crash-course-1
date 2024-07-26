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

    {{-- User list posts --}}
    <h2 class="title mt-10">Your Latest Posts</h2>
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            {{-- <x-postCard post="{{ $post }}" /> --}} 
            {{-- Biến post là 1 object nên không thể truyền như kiểu trên mà phải truyền như bên dưới --}}
            <x-postCard :post="$post">
                <p>Delete</p>
            </x-postCard>
        @endforeach
    </div>

    <div>
        {{ $posts -> links() }}
    </div>


</x-layout>