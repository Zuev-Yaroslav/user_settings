<template>
    <div class="bg-white p-4 rounded xl:w-3/4 xl:mx-auto mx-3 min-h-screen shadow-md">
        <h3 class="text-3xl mb-6">Edit profile settings</h3>
        <div class="mb-4">
            <label class="block mb-2">First name</label>
            <input v-model="entries.profile.first_name" class="w-1/2 rounded p-2 border-gray-300" placeholder="First name">
            <div v-if="errors.first_name" class="text-red-600 text-xs mx-1 mt-1">{{ errors.first_name[0] }}</div>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Second name</label>
            <input v-model="entries.profile.second_name" class="w-1/2 rounded p-2 border-gray-300" placeholder="Second name">
            <div v-if="errors.second_name" class="text-red-600 text-xs mx-1 mt-1">{{ errors.second_name[0] }}</div>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Third name</label>
            <input v-model="entries.profile.third_name" class="w-1/2 rounded p-2 border-gray-300" placeholder="Third name">
            <div v-if="errors.third_name" class="text-red-600 text-xs mx-1 mt-1">{{ errors.third_name[0] }}</div>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Birthed at</label>
            <input type="date" v-model="entries.profile.birthed_at" class="w-1/2 rounded p-2 border-gray-300">
            <div v-if="errors.birthed_at" class="text-red-600 text-xs mx-1 mt-1">{{ errors.birthed_at[0] }}</div>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Gender</label>
            <select v-model="entries.profile.gender" class="py-1 rounded border-gray-300">
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>
            <div v-if="errors.gender" class="text-red-600 text-xs mx-1 mt-1">{{ errors.gender[0] }}</div>
        </div>
        <div class="mb-4">
            <label class="block mb-2">About me</label>
            <textarea v-model="entries.profile.about_me" class="w-1/2 rounded p-2 border-gray-300" placeholder="About me"></textarea>
            <div v-if="errors.about_me" class="text-red-600 text-xs mx-1 mt-1">{{ errors.about_me[0] }}</div>
        </div>
        <div class="mb-3">
            <button @click.prevent="updateProfile" class="p-3 text-white rounded text-center hover:bg-emerald-500 bg-emerald-400">Save</button>
        </div>
        <div>
            <Link class="p-2 bg-blue-400 text-white rounded inline-block text-center hover:bg-blue-500" :href="route('profiles.show', profile.id)">Go back</Link>
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
    props: {
        profile: Object
    },
    data() {
        return {
            errors: {},
            entries: {
                profile: this.profile
            },
        }
    },
    mounted() {

    },
    methods: {
        updateProfile() {
            axios.patch(`/profiles/${this.profile.id}`, this.entries.profile).then(res => {
                this.$inertia.visit(`/profiles/${this.profile.id}`)
            }).catch(err => {
                if (err.response.data.message === 'not allowed'){
                    this.$inertia.visit('/profiles')
                }
            });
        }
    }
}
</script>
