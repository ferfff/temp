<div class="alert alert-{{ $type }} alert-dismissable mt-2 mb-2">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h3><i class="fas fa-exclamation-triangle"></i> <strong>{{ $title }}</strong></h3>
    <p>{{ $text }}</p>
    {{ $slot }}
</div>
