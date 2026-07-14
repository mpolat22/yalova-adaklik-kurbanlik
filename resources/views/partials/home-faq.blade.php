@if (!empty($faqs))
    <section class="section pb-0" id="sikca-sorulan-sorular">
        <div class="shell">
            <div class="relative overflow-hidden rounded-[2.4rem] border border-[#d8d0c3] bg-[linear-gradient(135deg,#fbf6ef_0%,#f3efe6_42%,#eef2ea_100%)] px-6 py-8 shadow-[0_28px_90px_rgba(73,54,34,0.10)] sm:px-8 sm:py-10 lg:px-12 lg:py-12">
                <div class="absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top_left,rgba(184,130,74,0.22),transparent_58%),radial-gradient(circle_at_top_right,rgba(111,118,105,0.18),transparent_52%)]"></div>
                <div class="absolute -left-16 bottom-0 h-44 w-44 rounded-full bg-[#d8b184]/18 blur-3xl"></div>
                <div class="absolute -right-10 top-16 h-36 w-36 rounded-full bg-[#9faa95]/18 blur-3xl"></div>

                <div class="relative z-10 flex justify-center">
                    <span class="section-badge">Sıkça Sorulan Sorular</span>
                </div>

                <div class="relative z-10 mx-auto max-w-4xl text-center">
                    <h2 class="mt-5 text-3xl font-extrabold text-brand-900 sm:text-4xl lg:text-[3.1rem] lg:leading-[1.04]">
                        Yalova Adaklık ve Kurbanlık Hakkında Merak Edilenler
                    </h2>
                    <p class="mx-auto mt-5 max-w-3xl text-base leading-8 text-[#5f625b] sm:text-[1.06rem] sm:leading-9">
                        Yalova’da adaklık ve kurbanlık seçimi, İslami usullere uygun kesim, ücretsiz parçalama ve paketleme, vekâlet hizmeti, fiyat ve ödeme seçenekleri hakkında sık sorulan soruların cevaplarını inceleyin.
                    </p>
                </div>

                <div class="relative z-10 mx-auto mt-8 grid max-w-5xl gap-4">
                    @foreach ($faqs as $faq)
                        <details
                            name="home-faq"
                            class="group rounded-[1.6rem] border border-[#decfbd] bg-white/78 px-5 py-1 shadow-[0_14px_34px_rgba(73,54,34,0.06)] backdrop-blur transition duration-300 open:bg-white/92 open:shadow-[0_18px_42px_rgba(73,54,34,0.10)] sm:px-6"
                            data-home-faq-item
                        >
                            <summary class="flex min-h-16 cursor-pointer list-none items-center justify-between gap-5 py-4 text-left text-[1.02rem] font-extrabold leading-7 text-brand-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 sm:text-[1.08rem]">
                                <span>{{ $faq['question'] }}</span>
                                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-[#d9c7b1] bg-[#fbf6ef] text-2xl font-light leading-none text-[#8d6641] transition duration-300 group-open:rotate-45" aria-hidden="true">+</span>
                            </summary>
                            <p class="border-t border-[#e6dbcd] pb-5 pt-4 text-base leading-8 text-[#5f625b] sm:pr-12">
                                {{ $faq['answer'] }}
                            </p>
                        </details>
                    @endforeach
                </div>

                <div class="relative z-10 mt-8 flex justify-center">
                    <a
                        href="{{ route('contact') }}"
                        class="button-primary group min-h-12 gap-2.5 px-6 py-3 text-sm shadow-[0_12px_26px_rgba(44,48,44,0.16)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2"
                    >
                        Bize Ulaşın
                        <span class="transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif