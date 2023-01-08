
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-image d-flex justify-content-center align-items-center" style="
    background-image: url({{url('img/background.jpg')}});
    height: 100vh;background-repeat:no-repeat;background-size:100% 100%;">
    

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

        {{ $logo }}

        <br>

        {{ $slot }}
    </div>
</div>
