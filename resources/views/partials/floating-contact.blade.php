<aside
    class="floating-contact is-open"
    data-floating-contact
    aria-label="Hızlı iletişim seçenekleri"
>
    <div id="floating-contact-actions" class="floating-contact__actions">
        <a
            href="https://wa.me/{{ $site['whatsapp_link'] }}"
            target="_blank"
            rel="noopener"
            class="floating-contact__action floating-contact__action--whatsapp"
            aria-label="WhatsApp üzerinden iletişime geçin"
        >
            <span class="floating-contact__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.1 4.9A9.9 9.9 0 0 0 3.3 16.8L2 22l5.3-1.3a9.9 9.9 0 0 0 4.7 1.2h.1A9.9 9.9 0 0 0 22 12 9.8 9.8 0 0 0 19.1 4.9Zm-7 15.3h-.1a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3.1.8.8-3-.2-.3a8.2 8.2 0 1 1 7.1 3.9Zm4.5-6.1c-.2-.1-1.4-.7-1.6-.8s-.4-.1-.6.1-.7.8-.9.9-.3.2-.6 0a6.8 6.8 0 0 1-2-1.2 7.6 7.6 0 0 1-1.4-1.8c-.1-.3 0-.4.1-.6l.4-.5.2-.4a.7.7 0 0 0 0-.5c0-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 2.9 2.9 0 0 0-.9 2.1c0 1.2.9 2.3 1 2.5.1.2 1.8 2.8 4.5 3.9.6.3 1.1.4 1.5.6.6.2 1.2.2 1.7.1.5-.1 1.4-.6 1.6-1.2.2-.6.2-1 .2-1.2-.1-.1-.3-.2-.5-.3Z" />
                </svg>
            </span>
            <span>
                <strong>WhatsApp İletişim</strong>
                <small>Mesaj Gönderin</small>
            </span>
        </a>

        <a
            href="tel:+{{ $site['phone_link'] }}"
            class="floating-contact__action floating-contact__action--phone"
            aria-label="{{ $site['phone_display'] }} numarasını hemen arayın"
        >
            <span class="floating-contact__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M6.6 3.5h2.6c.5 0 1 .4 1.1.9l.5 3.1c.1.5-.1 1-.5 1.3l-1.8 1.5a15.6 15.6 0 0 0 5.2 5.2l1.5-1.8c.3-.4.8-.6 1.3-.5l3.1.5c.5.1.9.6.9 1.1v2.6c0 .7-.6 1.3-1.3 1.3C10 20 4 14 4 6.8c0-.7.6-1.3 1.3-1.3Z" />
                </svg>
            </span>
            <span>
                <strong>Hemen Ara</strong>
                <small>{{ $site['phone_display'] }}</small>
            </span>
        </a>
    </div>
</aside>
