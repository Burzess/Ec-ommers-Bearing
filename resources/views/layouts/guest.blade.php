<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
                <a href="/">
                    <x-application-logo class="mx-auto h-24 w-auto" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-10 overflow-hidden relative">
