<template>
    <div class="dropdown mb-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            {{ options[current].label }}
        </button>
        <div class="dropdown-menu">
            <button
                v-for="(filter, name) in options"
                @click="handleClick(name)"
                class="dropdown-item"
                type="button"
            >
                {{ filter.label }}
            </button>
        </div>
    </div>
</template>

<script>
import options from '../utils/BookingFilters.ts';

export default {
    name: 'BookingFilter',

    data() {
        return {
            options,
            current: 'all',
        };
    },

    methods: {
        handleClick(newFilterName) {
            this.current = newFilterName;
            this.$emit('change', options[newFilterName]);
        },
    },
};
</script>