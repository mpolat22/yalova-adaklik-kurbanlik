<script setup>
const props = defineProps({
    items: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <div class="grid gap-4">
        <details
            v-for="(item, index) in items"
            :key="item.question"
            class="card group"
            :open="index === 0"
        >
            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-left text-lg font-bold text-brand-800">
                <span>{{ item.question }}</span>
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-brand-200/70 text-brand-600">+</span>
            </summary>
            <p class="mt-4 pr-6 text-base leading-8 text-ink-500">{{ item.answer }}</p>
        </details>
    </div>
</template>
