Hey {{ $user->username }}!

{{ $blueprint->discussion->startUser->username }} started a private discussion with you as recipient called {{ $blueprint->post->discussion->title }}.

{{ app()->url() }}/d/{{ $blueprint->discussion->id }}-{{ $blueprint->discussion->title }}
