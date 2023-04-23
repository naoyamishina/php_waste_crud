<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の一覧
        </h2>

        <x-message :message="session('message')" />

    </x-slot>

    {{-- 投稿一覧表示用のコード --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (count($posts) == 0)
                <p class="mt-4">
                あなたはまだ投稿していません。
                </p>
            @else
        @foreach ($posts as $post)
            <div class="mx-4 sm:p-8">
                <div class="mt-4">
                    <div class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">
                            <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left">
                                <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
                            </h1>
                            <hr class="w-full">
                            <p class="mt-4 py-4 whitespace-pre-line">￥{{$post->money}}</p>
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p>{{ $post->user->name }} • {{$post->created_at->format('Y年m月d日')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</x-app-layout>
