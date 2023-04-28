<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿一覧
        </h2>
        <x-message :message="session('message')" />
        <a href="{{route('post.create')}}"><button class="font-semibold text-lg text-white leading-tight bg-green-700 p-4 rounded-md my-4">新規作成</button></a>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('post.index') }}">
            <div class="md:flex items-center mt-8">
                <div class="flex">
                    <input type="search" class="w-auto py-2 placeholder-gray-400 border border-gray-300 rounded-md" placeholder="最小金額を入力" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
                    <button class="bg-gray-300 mx-4 p-2 rounded-md" type="submit">検索</button>
                    <button class="bg-gray-300 p-2 rounded-md">
                        <a href="{{ route('post.index') }}" class="">
                            クリア
                        </a>
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    {{-- 投稿一覧表示用のコード --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (count($posts) == 0)
            <p class="mt-4">
            まだ投稿はありません。
            </p>
        @else
            @each('post.components/post', $posts, 'post')
            <div class="mt-6 mb-4 items-center">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
