<template>
    <div>
        <div class="header-row">
            <h1>Fruits</h1>
        </div>
        <div class="header-row">
            <button @click="openFavorites">View Favorite Fruits</button>
            <div class="filter-container">
                <FilterForm @filter="applyFilter" />
            </div>
        </div>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Family</th>
                <th>Genus</th>
                <th>Order</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="fruit in fruits.data" :key="fruit.id">
                <td>{{ fruit.name }}</td>
                <td>{{ fruit.family }}</td>
                <td>{{ fruit.genus }}</td>
                <td>{{ fruit.order }}</td>
                <td>
                    <button @click="favoriteFruit(fruit.id)">Favorite</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="pagination-container">
            <a
                v-if="fruits.prev_page_url"
                :href="fruits.prev_page_url"
                class="pagination-button"
            >
                Previous
            </a>
            <a
                v-if="fruits.next_page_url"
                :href="fruits.next_page_url"
                class="pagination-button"
            >
                Next
            </a>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import FruitCard from '../components/FruitCard.vue';
import FilterForm from '../components/FilterForm.vue';
export default {
    components: {
        FruitCard,
        FilterForm,
    },
    props: {
        fruits: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            filters: {}
        };
    },
    methods: {
        favoriteFruit(fruitId) {
            axios.post(`/fruits/${fruitId}/favorite`)
                .then(() => alert('Fruit added to favorites!'))
                .catch(() => alert('Something went wrong'));
        },
        openFavorites() {
            window.location.href = '/favorites';
        },
        applyFilter(filters) {
            this.filters = filters;
            const params = new URLSearchParams(this.filters).toString();
            window.location.href = `/dashboard?${params}`;
        }
    }
};
</script>

