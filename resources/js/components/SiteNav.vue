<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    links: {
        type: Array,
        default: () => [],
    },
});

const isOpen = ref(false);

const toggle = () => {
    isOpen.value = !isOpen.value;
};

const wrapperClass = computed(() => [
    'absolute right-0 top-full z-40 mt-4 w-[16rem] rounded-[1.5rem] border border-brand-200/70 bg-white/96 p-4 shadow-2xl lg:static lg:mt-0 lg:flex lg:w-auto lg:items-center lg:justify-center lg:gap-7 lg:rounded-none lg:border-0 lg:bg-transparent lg:p-0 lg:shadow-none',
    isOpen.value ? 'block' : 'hidden lg:flex',
]);
</script>

<template>
    <div class="relative flex justify-end lg:w-auto lg:justify-center">
        <button
            class="inline-flex h-11 items-center justify-center rounded-full border border-brand-200/70 bg-white/80 px-4 text-sm font-bold text-brand-700 lg:hidden"
            type="button"
            @click="toggle"
        >
            Menü
        </button>

        <div :class="wrapperClass">
            <a
                v-for="link in links"
                :key="link.href"
                :href="link.href"
                class="block rounded-full px-4 py-3 text-[0.95rem] font-semibold transition lg:px-0 lg:py-0"
                :class="link.active ? 'text-brand-700' : 'text-ink-500 hover:text-brand-700'"
            >
                {{ link.label }}
            </a>
        </div>
    </div>
</template>