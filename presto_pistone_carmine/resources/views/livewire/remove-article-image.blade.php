<div>
    @if ($article->images->count() > 0)
        <div class="row">
            @foreach ($article->images as $key => $image)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $image->getUrl(300, 300) }}" 
                             class="card-img-top rounded shadow-sm" 
                             style="object-fit: cover; height: 250px;"
                             alt="Immagine {{ $key + 1 }} di {{ $article->title }}">

                        @if(Auth::check() && Auth::user()->isRevisor())
                            <div class="card-body d-flex justify-content-center align-items-center">
                            <button 
                                type="button" 
                                onclick="confirmDelete({{ $image->id }})" 
                                class="btn btn-outline-danger w-100">
                                <i class="fas fa-trash"></i> {{ __('ui.delete') }}
                            </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-3 text-center">
                    <img src="https://picsum.photos/400" 
                         class="img-fluid rounded shadow-sm mb-3" 
                         alt="Nessuna immagine">
                    <p class="text-muted fst-italic">Nessuna immagine disponibile per questo articolo</p>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- SCRIPT ELIMINAZIONE IMMAGINI --}}

@push('scripts')
<script>
    function confirmDelete(imageId) {
        Swal.fire({
            title: "Sei sicuro?",
            text: "L'immagine verrà eliminata definitivamente!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sì, elimina!",
            cancelButtonText: "Annulla",
            background: '#f8f9fa',
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('removeImage', imageId);
                
                Swal.fire({
                    title: "Eliminato!",
                    text: "L'immagine è stata rimossa.",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endpush

{{-- SCRIPT ELIMINAZIONE ARTICOLO --}}
@push('scripts')
<script>
    function confirmArticleDelete(form) {
        Swal.fire({
            title: "Sei davvero sicuro?",
            text: "Stai per eliminare l'INTERO articolo e tutte le sue immagini. Questa azione non è reversibile!",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sì, elimina tutto!",
            cancelButtonText: "Annulla"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endpush