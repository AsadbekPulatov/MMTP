@extends('admin.master')
@section('title',  __("messages.profile"))
@section('content')
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

{{--            @if(\Illuminate\Support\Facades\Auth::user()->role != 'admin')--}}
{{--                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                    <div class="max-w-xl">--}}
{{--                        @include('profile.partials.delete-user-form')--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
    </div>
@endsection
