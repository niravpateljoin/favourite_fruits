<template>
    <div class="border rounded p-4 shadow">
        <h3>{{ fruit.name }}</h3>
        <p><strong>Family:</strong> {{ fruit.family }}</p>
        <p><strong>Genus:</strong> {{ fruit.genus }}</p>
        <button @click="$emit('favorite', fruit.id)">Add to Favorites</button>
    </div>
</template>

<script>
export default {
    props: ['fruit']
};
</script>
