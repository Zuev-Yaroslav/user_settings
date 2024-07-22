<template>
    <ProfileLayout>
        <div v-if="profile" class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ profile.user.login }}</h5>
                <p class="card-text">Fullname: {{ profile.first_name }} {{ profile.second_name }} {{ profile.third_name }}</p>
                <p class="card-text">Gender: {{ profile.gender_title }}</p>
                <p class="card-text">Birth date: {{ profile.birthed_at }}</p>
                <p class="card-text">About me: {{ profile.about_me }}</p>
            </div>
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary" @click="sendVerificationModalToggle()">Edit</button>
        </div>
        <div>
            <Link class="btn btn-primary" :href="route('profile.index')">Go back</Link>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="sendVerification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Send Verification Code</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label class="form-label">Choose the method</label>
                            <select class="form-control" v-model="sendMethod">
                                <option value="email">Email</option>
                                <option value="telegram">Telegram</option>
                                <option value="sms">SMS</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="sendVerificationEdit()">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="verifyToEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Verify</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label class="form-label">Enter the code</label>
                            <input type="text" class="form-control" v-model="code">
                            <div v-if="incorrect" class="text-danger form-text">{{ incorrect }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="sendVerify()">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </ProfileLayout>
</template>
<script>
import ProfileLayout from "@/Layouts/ProfileLayout.vue";
import {Link} from "@inertiajs/vue3";
import { reactive } from 'vue'

export default {
    name: "Show",
    components: {Link, ProfileLayout},
    props: [
        'profile'
    ],
    data() {
        return {
            state: null,
            sendMethod: 'email',
            code: null,
            incorrect: '',
        }
    },
    mounted() {
        this.state = reactive({
            sendVerification: null,
        })
        this.state.sendVerification = new bootstrap.Modal('#sendVerification', {})
        this.state.verifyToEdit = new bootstrap.Modal('#verifyToEdit', {})
    },
    methods: {
        sendVerificationModalToggle(){
            this.state.sendVerification.toggle()
        },
        verifyToEditModalToggle(){
            this.state.verifyToEdit.toggle()
        },
        sendVerificationEdit(){
            axios.get(`/api/profiles/${this.profile.id}/send-verification-edit?send_method=${this.sendMethod}`).then(res => {
                this.sendVerificationModalToggle();
                this.verifyToEditModalToggle();
            });
        },
        sendVerify(){
            axios.post(`/api/profiles/${this.profile.id}/verify-to-edit`, {code: this.code})
                .then(res => {
                    this.incorrect = '';
                    this.verifyToEditModalToggle();
                    this.$inertia.visit(route('profile.edit', this.profile.id));
            })
                .catch(err => {
                    console.log(err)
                if (err.response.data.message === "Incorrect or expired"){
                    this.incorrect = 'Incorrect code or expired'
                }
            })
        }
    }
}
</script>
