<x-guest-layout>
    <div class="h-screen pb-14 bg-right bg-cover">
        <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center bg-yellow-50">
            <!--左側-->
            <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
                <h1 class="my-4 text-3xl md:text-5xl text-green-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">「実質無料」自慢</h1>
                <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                    お金では計れない思い出を自慢しよう！
                </p>
                <div class="flex w-full justify-center md:justify-start pb-8 lg:pb-0 fade-in ">
                    {{-- ボタン設定 --}}
                    <a href="{{route('login')}}"><x-primary-button class="btnsetg">ログイン</x-primary-button></a>
                    <a href="{{route('register')}}"><x-primary-button class="btnsetr">ご登録はこちら</x-primary-button></a>
                </div>
            </div>
            {{-- 右側 --}}
            <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
                <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{asset('logo/top_image_waste.jpg')}}">
            </div>
        </div>
        <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <div class="w-full text-sm text-center md:text-left fade-in border-2 p-4 leading-8 mb-8 bg-gray-100">
                <h2 class="text-2xl font-bold mb-2">そもそも「実質無料」とは</h2>
                <p class="text-base md:text-xl mb-4 text-center md:text-left">
                    アイドルなどのヲタクが通常の金銭感覚とは異なるお金の使い方をした時、それでも価値がある！と表明する言葉です。
                </p>
                <p></p>
            </div>
            <div class="w-full text-sm text-center md:text-left fade-in border-2 p-4 leading-8 mb-8 bg-gray-100">
                <h2 class="text-2xl font-bold mb-2">「実質無料」自慢（本アプリ）について</h2>
                <p class="text-base md:text-xl mb-4 text-center md:text-left">
                    ヲタクの方以外にも、贅沢をして多幸感を感じた経験があるかと思います！<br>
                    <br>
                    例えば、<br>
                    ・一粒数百円以上するチョコレートを食べた<br>
                    ・旅行先で普段はしない体験をした<br>
                    、、などなど<br>
                    <br>
                    このような経験を自慢し合おうというアプリです！！
                </p>
                <p></p>
            </div>
            <!--フッタ-->
            <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
                <p class="text-gray-500 text-center">@2023 「実質無料」自慢</p>
            </div>
        </div>
    </div>
    </x-guest-layout>
