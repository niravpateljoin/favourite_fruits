<template>
    <form @submit.prevent="submitFilter">
        <input v-model="name" placeholder="Filter by name" />
        <input v-model="family" placeholder="Filter by family" />
        <button type="submit">Apply Filters</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            family: '',
        };
    },
    methods: {
        submitFilter() {
            this.$emit('filter', {
                name: this.name,
                family: this.family,
            });
        },
    },
};
</script>
