<template>
    <div class="bg-white p-4 rounded xl:w-1/4 md:mx-auto md:w-1/2 mx-3 shadow-md">
        <div v-if="state === 0">
            <div class="mb-4">
                <label class="block mb-2">Choose method</label>
                <select v-model="verificationData.send_method" class="w-1/3 rounded p-2 border-gray-300">
                    <option value="email">Email</option>
                    <option value="telegram">Telegram</option>
                    <option value="sms">SMS</option>
                </select>
            </div>
            <a @click.prevent="sendVerificationNotification" class="p-2 text-white bg-blue-400 rounded inline-block text-center hover:bg-blue-500" href="#">Send</a>
        </div>
        <div v-else-if="state === 1">
            <div class="mb-4">
                <label class="block mb-2">Enter the code</label>
                <input type="text" class="w-1/3 rounded p-2 border-gray-300 mb-1" v-model="verifyData.code">
                <div v-if="incorrect" class="text-red-600 text-xs">{{ incorrect }}</div>
            </div>
            <a @click.prevent="verify" class="p-2 text-white bg-blue-400 rounded inline-block text-center hover:bg-blue-500" href="#">Send</a>
        </div>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "ShowVerificationSending",
    components: {Link},
    layout: MainLayout,
    data() {
        return {
            verificationData: {
                send_method: 'email',
            },
            verifyData: {},
            incorrect: '',
            state: 0,
        }
    },
    props: {
        profile: Object
    },
    methods: {
        sendVerificationNotification() {
            axios.post(route('profiles.send_verification_notification', this.profile.id), this.verificationData)
                .then(res => {
                    this.verificationData.send_method = 'email'
                    this.state = 1;
                })
        },
        verify() {
            axios.get(`/profiles/${this.profile.id}/verify`, {
                params: this.verifyData
            })
                .then(res => {
                    this.$inertia.visit(`/profiles/${this.profile.id}/edit`)
                })
                .catch(error => {
                    this.incorrect = error.response.data.message;
                })
        }
    }
}
</script>
