<div class="field mt-5">
    
    @if ($errors->{ $bag ?? 'default'}->any())
        @foreach($errors->{ $bag ?? 'default'}->all() as $error)
            <li>{{ $error }}</li>

        @endforeach
    @endif
</div>