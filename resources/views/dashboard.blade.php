@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">

        <div class="col-3">

            {{-- тут было начало блока left-sidebar --}}
            @include('shared.left-sidebar')
            {{-- тут был конец блока left-sidebar --}}

        </div>
        <div class="col-6">


            {{-- тут был кусок html-кода с сообщением об успешном добавлении идеи --}}
            @include('shared.success-message')

            {{-- тут был кусок html-кода с формой для отправки идей --}}
            @include('ideas.shared.submit-idea')
            <hr>


            @forelse ($ideas as $idea)
                <div class="mt-3">

                    {{-- тут был кусок html-кода с карточками идей, т.е. сами посты идей --}}
                    @include('ideas.shared.idea-card')

                </div>
            @empty

                <div class="mt-3">

                    <p class="text-center mt-4">No results found.</p>

                </div>
            @endforelse



            <div class="mt-3">
                {{ $ideas->withQueryString()->links() }}
            </div>

        </div>
        <div class="col-3">

            {{-- тут было начало блока Search --}}
            @include('shared.search-bar')
            {{-- тут был конец блока Search --}}

            {{-- тут было начало Who to follow --}}
            @include('shared.follow-box')
            {{-- тут был конец блока Who to follow --}}
        </div>
    </div>
@endsection
