<template>
    <MainLayout>
        <h3 class="mb-5">Profiles</h3>
        <slot />
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "ProfileLayout",
    components: {MainLayout}
}
</script>
