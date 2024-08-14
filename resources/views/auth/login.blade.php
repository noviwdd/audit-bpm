@extends('layout.app')
@section('content')
    <div class="flex flex-wrap w-full bg-white">
        <div class="flex flex-col w-full lg:w-1/2">
            {{-- <div class="flex justify-center pt-12 lg:justify-start lg:pl-12 lg:-mb-24">
			<a href="#" class="p-4 text-xl font-bold text-whiteSmoke">
				BPM
			</a>
		</div> --}}
            <div class="flex flex-col justify-center px-8 pt-8 my-auto lg:justify-start lg:pt-0 lg:px-24">
                <p class="text-3xl text-center font-bold text-jet underline underline-offset-4 decoration-teal">
                    Selamat Datang
                </p>
                <form action="{{ url('login') }}" method="POST" class="flex flex-col pt-3 md:pt-8">
                    @csrf
                    <div class="flex flex-col pt-2">
                        <div class="flex relative">
                            <input type="text" name="email"
                                class="mt-1 text-sm block w-full rounded-lg bg-neutral-50 border-gray-200 shadow-sm focus:bg-neutral-50 focus:border-teal focus:ring-0"
                                placeholder="Username">
                        </div>
                    </div>
                    <div class="flex flex-col pt-2 mb-6">
                        <div class="flex relative ">
                            <input type="password" name="password"
                                class="mt-1 text-sm block w-full rounded-lg bg-neutral-50 border-gray-200 shadow-sm focus:bg-neutral-50 focus:border-teal focus:ring-0"
                                placeholder="Password">
                        </div>
                    </div>
                    <button type="submit" class="bg-caribbean text-white hover:bg-white hover:text-caribbean rounded-lg p-2">Masuk</button>
                </form>
            </div>
        </div>
        <div
            class="hidden lg:flex lg:w-1/2 shadow-2xl shadow-gray bg-caribbean h-screen rounded-tl-[4rem] items-center justify-center">
            <img class="hidden object-cover md:block" src="{{ asset('img/login-image.svg') }}"/>
        </div>
    </div>
@endsection
