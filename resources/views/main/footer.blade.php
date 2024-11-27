<footer class="text-white w-3/4 place-self-center relative pt-20">
    <div class="flex flex-col items-center justify-center gap-6">
        <div class="flex flex-col">
            <div class="flex flex-row">
                <div class="flex flex-col gap-2 basis-3/6 ">
                    <h1 class="text-3xl">From list to bliss, your film journey awaits.</h1>
                    <p class="text-base text-[#9E9FA0]">Transform your movie wishes into a blissful journey. With our watchlist, you can manage your must-see films and never miss a favorite.</p>
                </div>
                <div class="basis-3/6 self-center flex justify-center">
                    <button class="btn btn-wide bg-[#CFF245] hover:bg-[#AAC73C] place-self-center">
                        <a href="{{ route('dashboard') }}">Search Your Movie</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex w-full flex-col">
            <div class="flex flex-row">
                <div class="flex flex-grow card rounded-box place-content-center basis-2/12">
                    <div class="flex flex-row gap-2 py-5">
                        <div class="size-10">
                            <img src="{{ asset('img/image_2024-05-11_110207674-removebg-preview.png') }}" alt="MovieStack Logo">
                        </div>
                        <div class="brand-name font-bold text-xl py-2 text-white">MovieStack</div>
                    </div>
                </div>
                <div class="divider divider-horizontal"></div>
                <div class="flex flex-row rounded-box place-content-center basis-10/12 justify-evenly">
                    <div class="bg-transparent text-[#9E9FA0] flex flex-col gap-2">
                        <div class="text-base place-self-center">Qhanakin Ahmad Zhavi</div>
                        <div class="text-base place-self-center">Firman Karunia Naibaho</div>
                        <div class="text-base place-self-center">Alfathin Suwailim</div>
                        <div class="text-base place-self-center">Muhammad Ilyas Hasibuan</div>
                        <div class="text-base place-self-center">Rifki Reysaad Bangun</div>
                    </div>
                    <div class="bg-transparent text-white flex flex-col gap-2">
                        <div class="text-base">231402071</div>
                        <div class="text-base">231402074</div>
                        <div class="text-base">231402096</div>
                        <div class="text-base">231402106</div>
                        <div class="text-base">231402109</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider divider-neutral"></div>
        <footer class="footer footer-center pb-4 bg-[#0D0E11] text-[#9E9FA0]">
            <aside>
                <p>Copyright © 2024 - All rights reserved</p>
            </aside>
        </footer>
        <div class="z-50 absolute bottom-0 w-full h-full">
            <img src="{{ asset('img/invert-cylinder.png') }}" class="w-full h-full">
        </div>
    </div>
</footer>