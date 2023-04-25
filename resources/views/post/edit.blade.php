<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の編集画面
        </h2>

        <x-validation-errors class="mb-4" :errors="$errors" />
        <x-message :message="session('message')" />

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                    <label for="body" class="font-semibold leading-none mt-4 mb-3">件名</label>
                    <input type="text" name="title" class="w-auto py-2 placeholder-gray-400 border border-gray-300 rounded-md" id="title" value="{{old('title', $post->title)}}" placeholder="(必須)">
                    </div>
                </div>

                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                    <label for="money" class="font-semibold leading-none mb-3">金額</label>
                    <input type="text" name="money" class="w-auto py-2 placeholder-gray-400 border border-gray-300 rounded-md" id="money" value="{{old('money', $post->money)}}" placeholder="￥(必須)">
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <label for="body" class="font-semibold leading-none mt-4 mb-3">思い出</label>
                    <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body', $post->body)}}</textarea>
                </div>

                <div class="w-full flex flex-col mt-4">
                    @if($post->image)
                        @if (App::environment('local'))
                            <img src="/{{ $image }}" class="mx-auto" style="height:300px;">
                        @else
                            // 本番環境
                            <img src="https://phpwastecrud.s3.ap-northeast-3.amazonaws.com/{{$image}}" class="mx-auto" style="height:300px;">
                        @endif
                    @endif
                    <label for="image" class="font-semibold leading-none mt-4">画像 （1MBまで）</label>
                    <div>
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <x-primary-button class="mt-4">
                    更新する
                </x-primary-button>
                
            </form>
        </div>
    </div>

</x-app-layout>
