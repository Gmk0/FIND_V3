<div>

    @if (!empty($user->profile_photo_path))

    @if(!empty($taille))

    <img class="w-{{ $taille }} h-{{ $taille }} object-cover rounded-full"
        src="{{Storage::disk('local')->url($user->profile_photo_path) }}" alt="">
    @else
    <img class="w-8 h-8 object-cover rounded-full" src="{{Storage::disk('local')->url($user->profile_photo_path) }}"
        alt="">

    @endif

    @else

    @if(!empty($taille))

    <img class="w-{{ $taille }} h-{{ $taille }} rounded-full" src="{{ $user->profile_photo_url ?? null }}" alt="">
    @else
    <img class="w-8 h-8 rounded-full" src="{{ $user->profile_photo_url ?? null }}" alt="">

    @endif


    @endif
</div>
