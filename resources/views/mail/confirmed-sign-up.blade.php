@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
<div class="flex flex-col justify-center items-center">
    <div class="bg-primary p-5 px-10 rounded-md">
        <h2 class="text-3xl text-white font-bold">Verify your email</h2>
    </div>
    <p class="text-xl font-medium text-primary my-5">
        Before you start booking our courses, you have to verify your email account!
        If you didn't register account on
    </p>
    <a class="bg-transparent border-secondary border font-medium text-xl text-secondary px-8 py-5 inline-block rounded-3xl transition hover:bg-secondary hover:text-white" href="{{$url}}">
        Verify now!
    </a>
</div>
