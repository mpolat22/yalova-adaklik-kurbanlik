import './bootstrap';
import { createApp } from 'vue';
import SiteNav from './components/SiteNav.vue';

const mountComponent = (selector, component) => {
    document.querySelectorAll(selector).forEach((element) => {
        const props = element.dataset.props ? JSON.parse(element.dataset.props) : {};

        createApp(component, props).mount(element);
    });
};

const setupRelatedServicesCarousel = () => {
    document.querySelectorAll('[data-related-carousel]').forEach((carousel) => {
        const track = carousel.querySelector('[data-carousel-track]');
        const cards = Array.from(carousel.querySelectorAll('[data-carousel-card]'));
        const prevButton = carousel.querySelector('[data-carousel-prev]');
        const nextButton = carousel.querySelector('[data-carousel-next]');

        if (!track || cards.length === 0 || !prevButton || !nextButton) {
            return;
        }

        let currentIndex = 0;

        const getVisibleCount = () => {
            if (window.innerWidth >= 1280) {
                return 4;
            }

            if (window.innerWidth >= 640) {
                return 2;
            }

            return 1;
        };

        const getStepSize = () => {
            if (cards.length < 2) {
                return cards[0]?.getBoundingClientRect().width ?? 0;
            }

            const firstRect = cards[0].getBoundingClientRect();
            const secondRect = cards[1].getBoundingClientRect();

            return secondRect.left - firstRect.left;
        };

        const updateCarousel = () => {
            const visibleCount = getVisibleCount();
            const maxIndex = Math.max(0, cards.length - visibleCount);
            const stepSize = getStepSize();

            currentIndex = Math.min(currentIndex, maxIndex);
            track.style.transform = `translateX(-${currentIndex * stepSize}px)`;

            prevButton.disabled = currentIndex === 0;
            nextButton.disabled = currentIndex >= maxIndex;


        };

        prevButton.addEventListener('click', () => {
            currentIndex = Math.max(0, currentIndex - 1);
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            const maxIndex = Math.max(0, cards.length - getVisibleCount());
            currentIndex = Math.min(maxIndex, currentIndex + 1);
            updateCarousel();
        });

        window.addEventListener('resize', updateCarousel, { passive: true });
        updateCarousel();
    });
};

const setupGallery = () => {
    document.querySelectorAll('[data-gallery-root]').forEach((gallery) => {
        const items = Array.from(gallery.querySelectorAll('[data-gallery-item]'));

        if (items.length === 0) {
            return;
        }

        const carousel = gallery.querySelector('[data-home-gallery-carousel]');

        if (carousel) {
            const track = carousel.querySelector('[data-gallery-carousel-track]');
            const prevButton = carousel.querySelector('[data-gallery-carousel-prev]');
            const nextButton = carousel.querySelector('[data-gallery-carousel-next]');

            if (track && prevButton && nextButton) {
                let currentIndex = 0;

                const getVisibleCount = () => {
                    if (window.innerWidth >= 1280) {
                        return 4;
                    }

                    if (window.innerWidth >= 640) {
                        return 2;
                    }

                    return 1;
                };

                const getStepSize = () => {
                    if (items.length < 2) {
                        return items[0]?.getBoundingClientRect().width ?? 0;
                    }

                    const firstRect = items[0].getBoundingClientRect();
                    const secondRect = items[1].getBoundingClientRect();

                    return secondRect.left - firstRect.left;
                };

                const updateCarousel = () => {
                    const maxIndex = Math.max(0, items.length - getVisibleCount());
                    const stepSize = getStepSize();

                    currentIndex = Math.min(currentIndex, maxIndex);
                    track.style.transform = 'translateX(-' + (currentIndex * stepSize) + 'px)';
                    prevButton.disabled = currentIndex === 0;
                    nextButton.disabled = currentIndex >= maxIndex;
                };

                prevButton.addEventListener('click', () => {
                    currentIndex = Math.max(0, currentIndex - 1);
                    updateCarousel();
                });

                nextButton.addEventListener('click', () => {
                    const maxIndex = Math.max(0, items.length - getVisibleCount());
                    currentIndex = Math.min(maxIndex, currentIndex + 1);
                    updateCarousel();
                });

                window.addEventListener('resize', updateCarousel, { passive: true });
                updateCarousel();
            }
        }

        const lightbox = document.querySelector('[data-gallery-lightbox-root]');

        if (!lightbox) {
            return;
        }

        const lightboxImage = lightbox.querySelector('[data-gallery-lightbox-image]');
        const lightboxCaption = lightbox.querySelector('[data-gallery-lightbox-caption]');
        const lightboxCounter = lightbox.querySelector('[data-gallery-lightbox-counter]');
        const lightboxBackdrop = lightbox.querySelector('[data-gallery-lightbox-backdrop]');
        const lightboxClose = lightbox.querySelector('[data-gallery-lightbox-close]');
        const lightboxPrev = lightbox.querySelector('[data-gallery-lightbox-prev]');
        const lightboxNext = lightbox.querySelector('[data-gallery-lightbox-next]');

        if (!lightboxImage || !lightboxCaption || !lightboxCounter || !lightboxBackdrop || !lightboxClose || !lightboxPrev || !lightboxNext) {
            return;
        }

        let activeIndex = 0;
        let previousFocus = null;
        let previousBodyOverflow = '';

        const renderLightbox = () => {
            const item = items[activeIndex];
            const source = item.dataset.gallerySrc ?? '';
            const alt = item.dataset.galleryAlt ?? '';

            lightboxImage.src = source;
            lightboxImage.alt = alt;
            lightboxCaption.textContent = alt;
            lightboxCounter.textContent = (activeIndex + 1) + ' / ' + items.length;

            const nextIndex = (activeIndex + 1) % items.length;
            const previousIndex = (activeIndex - 1 + items.length) % items.length;

            [nextIndex, previousIndex].forEach((index) => {
                const preload = new Image();
                preload.src = items[index].dataset.gallerySrc ?? '';
            });
        };

        const showRelativeItem = (direction) => {
            activeIndex = (activeIndex + direction + items.length) % items.length;
            renderLightbox();
        };

        const openLightbox = (index, trigger) => {
            activeIndex = index;
            previousFocus = trigger;
            previousBodyOverflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';

            renderLightbox();
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            lightbox.setAttribute('aria-hidden', 'false');

            window.requestAnimationFrame(() => {
                lightboxClose.focus();
            });
        };

        const closeLightbox = () => {
            if (lightbox.classList.contains('hidden')) {
                return;
            }

            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            lightbox.setAttribute('aria-hidden', 'true');
            lightboxImage.removeAttribute('src');
            document.body.style.overflow = previousBodyOverflow;

            if (previousFocus instanceof HTMLElement) {
                previousFocus.focus();
            }
        };

        items.forEach((item, index) => {
            item.addEventListener('click', () => {
                openLightbox(index, item);
            });
        });

        lightboxBackdrop.addEventListener('click', closeLightbox);
        lightboxClose.addEventListener('click', closeLightbox);
        lightboxPrev.addEventListener('click', () => showRelativeItem(-1));
        lightboxNext.addEventListener('click', () => showRelativeItem(1));

        document.addEventListener('keydown', (event) => {
            if (lightbox.classList.contains('hidden')) {
                return;
            }

            if (event.key === 'ArrowLeft') {
                event.preventDefault();
                showRelativeItem(-1);
                return;
            }

            if (event.key === 'ArrowRight') {
                event.preventDefault();
                showRelativeItem(1);
                return;
            }

            if (event.key === 'Escape') {
                event.preventDefault();
                closeLightbox();
                return;
            }

            if (event.key !== 'Tab') {
                return;
            }

            const focusableElements = Array.from(lightbox.querySelectorAll('button:not([disabled])'));

            if (focusableElements.length === 0) {
                return;
            }

            const firstFocusable = focusableElements[0];
            const lastFocusable = focusableElements[focusableElements.length - 1];

            if (event.shiftKey && document.activeElement === firstFocusable) {
                event.preventDefault();
                lastFocusable.focus();
            } else if (!event.shiftKey && document.activeElement === lastFocusable) {
                event.preventDefault();
                firstFocusable.focus();
            }
        });
    });
};

mountComponent('[data-site-nav]', SiteNav);

if (document.querySelector('[data-faq-list]')) {
    import('./components/FaqList.vue').then(({ default: FaqList }) => {
        mountComponent('[data-faq-list]', FaqList);
    });
}

setupRelatedServicesCarousel();
setupGallery();