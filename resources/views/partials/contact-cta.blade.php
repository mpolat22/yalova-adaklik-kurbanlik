@php
    $isContactPage = request()->routeIs('contact');
    $contactCtaTitle = $isContactPage
        ? 'Telefon, WhatsApp ve Konum Bilgilerimiz'
        : "Yalova'da Adaklık ve Kurbanlık İçin Bize Ulaşın";
    $contactCtaDescription = $isContactPage
        ? 'Adaklık ve kurbanlık hakkında bilgi almak için Serhat Elgin veya Sercan Elgin’e telefonla ulaşabilir; WhatsApp, e-posta, sosyal medya ve harita bağlantılarımızı kullanabilirsiniz.'
        : "Çiftlikköy Yalova'daki işletmemizde adaklık, kurbanlık, akika ve şükür kurbanı için bize doğrudan ulaşabilirsiniz. Telefon, WhatsApp, sosyal medya ve konum bilgilerimiz üzerinden hızlıca iletişim kurabilir, merak ettiğiniz konular hakkında net bilgi alabilirsiniz.";
@endphp
<section class="section pt-4 sm:pt-6">
    <div class="shell">
        <div class="relative overflow-hidden rounded-[2.4rem] border border-[#d8d0c3] bg-[linear-gradient(135deg,#fbf6ef_0%,#f3efe6_42%,#eef2ea_100%)] px-6 py-10 shadow-[0_28px_90px_rgba(73,54,34,0.10)] sm:px-8 sm:py-12 lg:px-12 lg:py-14">
            <div class="absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top_left,rgba(184,130,74,0.22),transparent_58%),radial-gradient(circle_at_top_right,rgba(111,118,105,0.18),transparent_52%)]"></div>
            <div class="absolute -left-16 bottom-0 h-44 w-44 rounded-full bg-[#d8b184]/18 blur-3xl"></div>
            <div class="absolute -right-10 top-16 h-36 w-36 rounded-full bg-[#9faa95]/18 blur-3xl"></div>

            <div class="relative z-10 mx-auto max-w-4xl text-center">
                <span class="section-badge">
                    İletişim
                </span>
                <h2 class="mt-5 text-3xl font-extrabold text-brand-900 sm:text-4xl lg:text-[3.1rem] lg:leading-[1.04]">
                    {{ $contactCtaTitle }}
                </h2>
                <p class="mx-auto mt-5 max-w-3xl text-base leading-8 text-[#5f625b] sm:text-[1.06rem] sm:leading-9">
                    {{ $contactCtaDescription }}
                </p>
            </div>

            <div class="relative z-10 mx-auto mt-8 h-[2px] max-w-5xl bg-[linear-gradient(90deg,rgba(184,130,74,0),rgba(184,130,74,0.95),rgba(111,118,105,0.92),rgba(184,130,74,0))]"></div>

            <div class="relative z-10 mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <a href="tel:+{{ $site['phone_link'] }}" class="rounded-[1.7rem] border border-[#decdb8] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur transition hover:border-[#c98f54] hover:bg-white/86">
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#c98f54] text-white shadow-[0_10px_24px_rgba(201,143,84,0.28)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M6.6 3.5h2.6c.5 0 1 .4 1.1.9l.5 3.1c.1.5-.1 1-.5 1.3l-1.8 1.5a15.6 15.6 0 0 0 5.2 5.2l1.5-1.8c.3-.4.8-.6 1.3-.5l3.1.5c.5.1.9.6.9 1.1v2.6c0 .7-.6 1.3-1.3 1.3C10 20 4 14 4 6.8c0-.7.6-1.3 1.3-1.3Z"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[0.76rem] font-extrabold uppercase tracking-[0.22em] text-[#9d6d43]">Telefon</p>
                            <p class="mt-2 text-[1.02rem] font-extrabold text-brand-900">Serhat Elgin</p>
                            <p class="mt-2 text-base font-semibold text-brand-900">{{ $site['phone_display'] }}</p>
                        </div>
                    </div>
                </a>

                <a href="tel:+{{ $site['secondary_phone_link'] }}" class="rounded-[1.7rem] border border-[#decdb8] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur transition hover:border-[#c98f54] hover:bg-white/86">
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#c98f54] text-white shadow-[0_10px_24px_rgba(201,143,84,0.28)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M6.6 3.5h2.6c.5 0 1 .4 1.1.9l.5 3.1c.1.5-.1 1-.5 1.3l-1.8 1.5a15.6 15.6 0 0 0 5.2 5.2l1.5-1.8c.3-.4.8-.6 1.3-.5l3.1.5c.5.1.9.6.9 1.1v2.6c0 .7-.6 1.3-1.3 1.3C10 20 4 14 4 6.8c0-.7.6-1.3 1.3-1.3Z"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[0.76rem] font-extrabold uppercase tracking-[0.22em] text-[#9d6d43]">Telefon</p>
                            <p class="mt-2 text-[1.02rem] font-extrabold text-brand-900">Sercan Elgin</p>
                            <p class="mt-2 text-base font-semibold text-brand-900">{{ $site['secondary_phone_display'] }}</p>
                        </div>
                    </div>
                </a>

                <div class="rounded-[1.7rem] border border-[#cfe0cf] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur">
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#6f8a67] text-white shadow-[0_10px_24px_rgba(111,138,103,0.28)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="currentColor" aria-hidden="true">
                                <path d="M19.1 4.9A9.9 9.9 0 0 0 3.3 16.8L2 22l5.3-1.3a9.9 9.9 0 0 0 4.7 1.2h.1A9.9 9.9 0 0 0 22 12 9.8 9.8 0 0 0 19.1 4.9Zm-7 15.3h-.1a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3.1.8.8-3-.2-.3a8.2 8.2 0 1 1 7.1 3.9Zm4.5-6.1c-.2-.1-1.4-.7-1.6-.8s-.4-.1-.6.1-.7.8-.9.9-.3.2-.6 0a6.8 6.8 0 0 1-2-1.2 7.6 7.6 0 0 1-1.4-1.8c-.1-.3 0-.4.1-.6l.4-.5.2-.4a.7.7 0 0 0 0-.5c0-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 2.9 2.9 0 0 0-.9 2.1c0 1.2.9 2.3 1 2.5.1.2 1.8 2.8 4.5 3.9.6.3 1.1.4 1.5.6.6.2 1.2.2 1.7.1.5-.1 1.4-.6 1.6-1.2.2-.6.2-1 .2-1.2-.1-.1-.3-.2-.5-.3Z" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-[0.76rem] font-extrabold uppercase tracking-[0.22em] text-[#6f8a67]">WhatsApp</p>
                            <div class="mt-2 text-base font-semibold text-brand-900">
                                <a href="https://wa.me/{{ $site['whatsapp_link'] }}" target="_blank" rel="noopener" class="block hover:text-[#6f8a67]">WhatsApp'tan Ulaşın</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.7rem] border border-[#e1d2e8] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur">
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#8b6f4e] text-white shadow-[0_10px_24px_rgba(139,111,78,0.24)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <rect x="3.5" y="3.5" width="17" height="17" rx="4"></rect>
                                <circle cx="12" cy="12" r="4.2"></circle>
                                <circle cx="17.3" cy="6.7" r="1.1" fill="currentColor" stroke="none"></circle>
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-[0.76rem] font-extrabold uppercase tracking-[0.22em] text-[#8b6f4e]">Sosyal Medya</p>
                            <div class="mt-3 flex gap-2">
                                <a href="{{ $site['instagram_url'] }}" target="_blank" rel="noopener" aria-label="Instagram" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-[#d8c4af] bg-[#fff8f0] text-brand-900 transition hover:border-[#8b6f4e] hover:text-[#8b6f4e]">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                        <rect x="3.5" y="3.5" width="17" height="17" rx="4"></rect>
                                        <circle cx="12" cy="12" r="4.2"></circle>
                                        <circle cx="17.3" cy="6.7" r="1.1" fill="currentColor" stroke="none"></circle>
                                    </svg>
                                </a>
                                <a href="{{ $site['facebook_url'] }}" target="_blank" rel="noopener" aria-label="Facebook" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-[#d8c4af] bg-[#fff8f0] text-brand-900 transition hover:border-[#8b6f4e] hover:text-[#8b6f4e]">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor" aria-hidden="true">
                                        <path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.6 1.7-1.6H17V4.8c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.4V11H7.5v3h2.8v8h3.2Z" />
                                    </svg>
                                </a>
                                <a href="mailto:{{ $site['email'] }}" aria-label="E-posta" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-[#d8c4af] bg-[#fff8f0] text-brand-900 transition hover:border-[#8b6f4e] hover:text-[#8b6f4e]">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                        <path d="M4 7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 16.5v-9Z"></path>
                                        <path d="m5.5 7 6.5 5 6.5-5"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.7rem] border border-[#d9d0c3] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur md:col-span-2 xl:col-span-4">
                    <div class="flex gap-4">
                        <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#b6805e] text-white shadow-[0_10px_24px_rgba(182,128,94,0.28)]">
                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M12 20s6-5.2 6-10a6 6 0 1 0-12 0c0 4.8 6 10 6 10Z"></path>
                                <circle cx="12" cy="10" r="2.3"></circle>
                            </svg>
                        </span>
                        <div class="max-w-3xl">
                            <p class="text-[0.8rem] font-extrabold uppercase tracking-[0.22em] text-[#7f5536]">Konum</p>
                            <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-2 text-base">
                                <p class="font-semibold text-brand-900">{{ $site['address'] }}</p>
                                <a href="{{ $site['maps_url'] }}" target="_blank" rel="noopener" class="inline-flex font-extrabold text-[#9d6d43] transition hover:text-brand-900">Haritada Görüntüleyin</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($isContactPage)
                    <div class="rounded-[1.7rem] border border-[#d2dccf] bg-white/72 p-5 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur md:col-span-2 xl:col-span-4" data-public-transport>
                        <div class="flex gap-4">
                            <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#6f8a67] text-white shadow-[0_10px_24px_rgba(111,138,103,0.28)]">
                                <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <rect x="4" y="3.5" width="16" height="16" rx="3"></rect>
                                    <path d="M7 7.5h10M7 11.5h10M7.5 19.5v1.5M16.5 19.5v1.5"></path>
                                    <circle cx="8" cy="16" r="1"></circle>
                                    <circle cx="16" cy="16" r="1"></circle>
                                </svg>
                            </span>
                            <div class="max-w-3xl">
                                <p class="text-[0.8rem] font-extrabold uppercase tracking-[0.22em] text-[#587052]">Ulaşım</p>
                                <h3 class="mt-2 text-[1.08rem] font-extrabold text-brand-900">Toplu Taşımayla Ulaşım</h3>
                                <p class="mt-2 text-base leading-8 text-[#5f625b]">İşletmemize dolmuş ve minibüsle kolayca ulaşabilirsiniz. Toplu taşıma araçları işletmemizin doğrudan önünden geçmektedir.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
