<x-layout>
    @push('style')
    <style>
        body {
            background-image: url("{{ asset('img/create_article_bg.jpg') }}") !important;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
    @endpush
    <div class="container pt-5">

        </div>
        <div class="row justify-content-center align-items-center height-custom">
            <div class="col-12 col-md-6 ">
                <livewire:create-article-form />
            </div>
        </div>
    </div>
</x-layout>
