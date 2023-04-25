<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の個別表示
        </h2>

        <x-message :message="session('message')" />

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <div class="px-10 mt-4">

                <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                    <h1 class="text-lg text-gray-700 font-semibold">
                        {{ $post->title }}
                    </h1>
                        <hr class="w-full">
                    </div>

                    @if (Auth::user()->id == $post->user->id)
                        <div class="flex justify-end mt-4">
                            <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-green-700 float-right">編集</x-primary-button></a>
                            <form method="post" action="{{route('post.destroy', $post)}}">
                            @csrf
                            @method('delete')
                                <x-primary-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                            </form>
                        </div>
                    @endif
                        <p class="mt-4 py-4 whitespace-pre-line">￥{{$post->money}}</p>
                        <p class="mt-4 text-gray-600 py-4 whitespace-pre-line">{{$post->body}}</p>
                        <div class="mt-4">
                            @if($post->image)
                                @if (App::environment('local'))
                                    <img src="/{{ $image }}" class="mx-auto" style="height:300px;">
                                @else
                                    // 本番環境
                                    <img src="https://phpwastecrud.s3.ap-northeast-3.amazonaws.com/{{$image}}" class="mx-auto" style="height:300px;">
                                @endif
                            @endif
                        </div>
                        <div class="text-sm font-semibold flex flex-row-reverse">
                            <p> {{ $post->user->name }} • {{$post->created_at->format('Y年m月d日')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
