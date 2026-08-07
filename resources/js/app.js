document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('floating-contact-btn');
    const links = document.getElementById('floating-contact-links');
    const iconChat = document.getElementById('floating-contact-icon-chat');
    const iconClose = document.getElementById('floating-contact-icon-close');

    if (!btn || !links) return;

    let open = false;

    function show() {
        open = true;
        links.classList.remove('opacity-0', 'scale-75', 'translate-y-2', 'pointer-events-none');
        links.classList.add('opacity-100', 'scale-100', 'translate-y-0');
        iconChat.classList.add('hidden');
        iconClose.classList.remove('hidden');
    }

    function hide() {
        open = false;
        links.classList.add('opacity-0', 'scale-75', 'translate-y-2', 'pointer-events-none');
        links.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
        iconChat.classList.remove('hidden');
        iconClose.classList.add('hidden');
    }

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        open ? hide() : show();
    });

    document.addEventListener('click', (e) => {
        if (open && !e.target.closest('#floating-contact')) {
            hide();
        }
    });
});
