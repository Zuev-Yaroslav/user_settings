<template>
    <div class="bg-white p-4 rounded xl:w-3/4 xl:mx-auto mx-3 min-h-screen shadow-md">
        <div v-if="profiles.length > 0" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
            <div v-for="profile in profiles" class="rounded border p-3">
                <div>
                    <p class="font-bold">{{ profile.user.login }}</p>
                    <p>{{ profile.first_name }} {{ profile.second_name }}</p>
                    <p>{{ profile.gender_title }}</p>
                    <div class="justify-end flex">
                        <Link class="p-2 bg-blue-400 text-white rounded inline-block text-center hover:bg-blue-500" :href="route('profiles.show', profile.id)" >Show</Link>
                    </div>
                </div>
            </div>
        </div>
        <p v-else >There is not profiles</p>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    layout: MainLayout,
    props: {
        profiles: Array
    },
    components: {
        Link
    }
}
</script>

<style scoped>

</style>
