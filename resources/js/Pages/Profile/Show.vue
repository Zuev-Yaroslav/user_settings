<template>
    <div class="bg-white p-4 rounded xl:w-3/4 xl:mx-auto mx-3 min-h-screen shadow-md">
        <div class="mb-4">
            <h3 class="mb-4 text-2xl font-bold">{{ profile.user.login }}</h3>
            <p class="mb-3">Fullname: {{ profile.first_name }} {{ profile.second_name }} {{ profile.third_name }}</p>
            <p class="mb-3">Gender: {{ profile.gender_title }}</p>
            <p class="mb-3">Birth date: {{ profile.birthed_at }}</p>
            <p class="mb-3">About me: {{ profile.about_me }}</p>
        </div>
        <div class="mb-3">
            <Link class="p-2 text-white bg-emerald-400 rounded inline-block text-center hover:bg-emerald-500" :href="route('profiles.edit', profile.id)">Edit</Link>
        </div>
        <div>
            <Link class="p-2 bg-blue-400 text-white rounded inline-block text-center hover:bg-blue-500" :href="route('profiles.index')">Go back</Link>
        </div>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Show",
    components: {Link},
    layout: MainLayout,
    props: [
        'profile'
    ],
    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {

    }
}
</script>
