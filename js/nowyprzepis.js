document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('.textarea-krok-przygotowania');

    textarea.addEventListener('input', () => {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    });
});