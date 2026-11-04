@extends('layouts.public')

@section('title', 'Rekrutacja')
@section('body_class', 'recruitment-page')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<style>
   /* Style trybu edycji */
.admin-edit-active .draggable-zone {
    border: 2px dashed #cbd5e1 !important;
    padding: 15px !important;
    margin-bottom: 20px !important;
    border-radius: 12px !important;
    position: relative !important;
    min-height: 80px;
}

.admin-edit-active .draggable-block {
    position: relative !important;
    border: 1px dashed #0d6efd !important;
    margin-bottom: 10px !important;
    border-radius: 8px !important;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}

/* Styl dla elementów przeciąganych w trakcie ruchu */
.sortable-ghost {
    opacity: 0.4 !important;
    background-color: #e2e8f0 !important;
    border: 2px dashed #0d6efd !important;
}

.sortable-chosen {
    box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;
}

/* Pasek narzędziowy przy bloku */
.block-toolbar {
    display: none;
    position: absolute;
    top: -14px;
    right: 10px;
    z-index: 1050;
    background: #ffffff;
    border: 1px solid #0d6efd;
    border-radius: 20px;
    padding: 2px 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.admin-edit-active .draggable-block:hover > .block-toolbar,
.admin-edit-active .draggable-zone:hover > .block-toolbar {
    display: flex;
    gap: 4px;
}

.drag-handle { cursor: grab; }
.drag-handle:active { cursor: grabbing; }

/* Styl usprawniający zmiane rozmiaru tekstu/obrazu w TinyMCE */
.admin-edit-active .page-section {
    outline: 1px dashed #94a3b8;
    padding: 8px;
    border-radius: 6px;
}
</style>

<main class="main py-5 bg-light">
    <div class="container">

        {{-- Pasek Administratora --}}
        @auth
            @if(auth()->user()->hasMinRole('admin'))
                <div class="alert alert-warning d-flex justify-content-between align-items-center mb-4 shadow-sm rounded-4 sticky-top" style="z-index: 10000; top: 10px;">
                    <span><i class="bi bi-shield-lock-fill me-2"></i><strong>Tryb Edycji:</strong> Możesz edytować teksty, przeciągać bloki myszką (Drag & Drop) oraz wgrywać pliki.</span>
                    <button type="button" id="toggle-edit-btn" class="btn btn-primary fw-bold px-4">
                        <i class="bi bi-pencil-square me-2"></i>Włącz edycję strony
                    </button>
                </div>
            @endif
        @endauth

        {{-- Ukryty input do wgrywania plików z komputera --}}
        <input type="file" id="global-file-input" style="display: none;" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip">

        <form action="{{ route('pages.update') }}" method="POST" id="recruitment-form">
            @csrf
            @method('PUT')

            <textarea name="content" id="hidden-content" style="display: none;"></textarea>

            {{-- DYNAMICZNA TREŚĆ WCZYTYWANA Z STORAGE --}}
            <div id="main-sortable-container" class="draggable-zone">
                {!! $content !!}
            </div>

            {{-- PRZYCISK ZAPISU --}}
            @auth
                @if(auth()->user()->hasMinRole('admin'))
                    <div id="save-bar" class="text-center my-4" style="display: none;">
                        <button type="submit" id="save-btn" class="btn btn-success btn-lg px-5 shadow rounded-pill">
                            <i class="bi bi-check-circle-fill me-2"></i>Zapisz zmiany na stronie
                        </button>
                    </div>
                @endif
            @endauth

        </form>

        <div class="text-center mt-5">
            <img src="{{ asset('college/assets/img/logo_BT_firmowy-papier.png') }}" alt="Logo ZS Czernikowo" height="80" class="img-fluid opacity-75">
        </div>

    </div>
</main>

{{-- SKRYPT ZARZĄDZANIA EDYCJĄ I DRAG & DROP --}}
@auth
    @if(auth()->user()->hasMinRole('admin'))
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
        <script>
           document.addEventListener("DOMContentLoaded", function() {
    const btnToggle = document.getElementById('toggle-edit-btn');
    const form = document.getElementById('recruitment-form');
    const fileInput = document.getElementById('global-file-input');
    let activeTargetWrapper = null;
    let sortableInstances = [];

    if (btnToggle) {
        btnToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            document.body.classList.toggle('admin-edit-active');
            const isActive = document.body.classList.contains('admin-edit-active');

            // Blokowanie otwierania linków podczas edycji
            document.querySelectorAll('.file-link-element').forEach(a => {
                if (isActive) {
                    a.addEventListener('click', preventLinkClick);
                } else {
                    a.removeEventListener('click', preventLinkClick);
                }
            });

            if (isActive) {
                // 1. Główny kontener - do przesuwania dużych sekcji (pionowo)
                const mainContainer = document.getElementById('main-sortable-container');
                if(mainContainer) {
                    sortableInstances.push(new Sortable(mainContainer, {
                        animation: 150,
                        handle: '.drag-handle',
                        draggable: '> .draggable-block',
                        ghostClass: 'sortable-ghost',
                        chosenClass: 'sortable-chosen'
                    }));
                }

                // 2. Wewnętrzne strefy (np. rządki z przyciskami PDF/Word/Excel)
                document.querySelectorAll('.inner-sortable-zone').forEach(zone => {
                    sortableInstances.push(new Sortable(zone, {
                        group: {
                            name: 'shared-files',
                            pull: true,  // Zezwalaj na wyciąganie
                            put: true    // Zezwalaj na wkładanie
                        },
                        animation: 150,
                        handle: '.drag-handle',
                        draggable: '.draggable-block',
                        ghostClass: 'sortable-ghost',
                        chosenClass: 'sortable-chosen',
                        // Pozwala na przeciąganie w poziomie (lewo/prawo)
                        direction: 'horizontal', 
                        fallbackOnBody: true,
                        swapThreshold: 0.65
                    }));
                });

                // 3. Włączenie edytora tekstu TinyMCE dla sekcji tekstowych
                tinymce.init({
                    selector: '.page-section',
                    inline: true,
                    language: 'pl',
                    plugins: 'link table code lists image media resizable',
                    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright | bullist numlist | table image | code',
                    extended_valid_elements: 'div[*],span[*],a[*],i[*],img[*]',
                    image_advtab: true
                });

                document.getElementById('save-bar').style.display = 'block';
                this.innerText = 'Wyłącz tryb edycji';
                this.classList.remove('btn-primary');
                this.classList.add('btn-outline-danger');
            } else {
                // Wyłączanie edycji
                tinymce.remove();
                sortableInstances.forEach(instance => instance.destroy());
                sortableInstances = [];

                document.getElementById('save-bar').style.display = 'none';
                this.innerText = 'Włącz edycję strony';
                this.classList.remove('btn-outline-danger');
                this.classList.add('btn-primary');
            }
        });
    }

    function preventLinkClick(e) { e.preventDefault(); }

    // globalny nasłuchiwacz zdarzeń (kliknięcia w przyciski usuwania i podmieniania plików)
    document.addEventListener('click', function(e) {
        // Podmiana pliku
        const uploadBtn = e.target.closest('.btn-upload-file');
        if (uploadBtn) {
            e.preventDefault();
            activeTargetWrapper = uploadBtn.closest('.file-editable-wrapper');
            fileInput.click();
        }

        // Usuwanie wybranego pliku lub sekcji
        const deleteBtn = e.target.closest('.btn-delete-block');
        if (deleteBtn) {
            e.preventDefault();
            e.stopPropagation(); // Blokuje propagację zdarzenia
            
            const targetBlock = deleteBtn.closest('.draggable-block');
            if (targetBlock && confirm('Czy na pewno chcesz usunąć ten element?')) {
                targetBlock.remove();
            }
        }
    });

    // Obsługa wczytywania nowego pliku
    fileInput.addEventListener('change', function() {
        if (this.files.length === 0 || !activeTargetWrapper) return;

        const file = this.files[0];
        const formData = new FormData();
        formData.append('file', file);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("pages.upload_file") }}', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const linkElement = activeTargetWrapper.querySelector('.file-link-element');
                if (linkElement) {
                    linkElement.setAttribute('href', data.url);
                    alert('Plik został podmieniony!');
                }
            } else {
                alert(data.message || 'Błąd wgrywania pliku.');
            }
        })
        .catch(error => alert('Wystąpił błąd serwera podczas wgrywania.'));
    });

    // Zapis do serwera (wysyłka JSON / Fetch)
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const clone = document.getElementById('main-sortable-container').cloneNode(true);
            
            // Czyszczenie narzędzi i stylów trybu edytora przed zapisem HTML do bazy/Storage
            clone.querySelectorAll('.block-toolbar').forEach(el => el.remove());
            clone.querySelectorAll('.draggable-block').forEach(el => el.classList.remove('draggable-block'));
            clone.querySelectorAll('.draggable-zone').forEach(el => el.classList.remove('draggable-zone'));
            clone.querySelectorAll('.inner-sortable-zone').forEach(el => el.classList.remove('inner-sortable-zone'));
            clone.querySelectorAll('.mce-content-body').forEach(el => {
                el.removeAttribute('contenteditable');
                el.removeAttribute('spellcheck');
                el.classList.remove('mce-content-body', 'mce-edit-focus');
            });

            const htmlContent = clone.innerHTML;

            fetch('{{ route("pages.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'PUT',
                    content: htmlContent
                })
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(res => {
                if (res.status === 403) {
                    alert('Błąd 403: Brak uprawnień do zapisu.');
                    return;
                }
                if (res.body && res.body.success) {
                    alert('Strona została zaktualizowana!');
                    window.location.reload();
                } else {
                    alert(res.body.message || 'Błąd podczas zapisu.');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Błąd połączenia z serwerem.');
            });
        });
    }
});
        </script>
    @endif
@endauth
@endsection