<template>
    <ProfileLayout>
        <div class="mb-3">
            <label class="form-label">Login</label>
            <input readonly type="text" class="form-control" v-model="login">
            <div class="text-danger form-text"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">First name</label>
            <input type="text" class="form-control" v-model="firstName">
        </div>
        <div class="mb-3">
            <label class="form-label">Second name</label>
            <input type="text" class="form-control" v-model="secondName">
        </div>
        <div class="mb-3">
            <label class="form-label">Third name</label>
            <input type="text" class="form-control" v-model="thirdName">
        </div>
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select class="form-select" v-model="gender">
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Birthed at</label>
            <input type="date" class="form-control" v-model="birthedAt">
        </div>
        <div class="mb-3">
            <label class="form-label">About me</label>
            <textarea class="form-control" v-model="aboutMe"></textarea>
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-success" @click="update()">Save</button>
        </div>
        <div class="mb-3">
            <Link type="button" class="btn btn-primary" :href="route('profile.show', profile.id)">Go back</Link>
        </div>
        <div class="modal fade" id="errorModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">Access denied</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </ProfileLayout>
</template>

<script>
import ProfileLayout from "@/Layouts/ProfileLayout.vue";
import {reactive} from "vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Edit",
    components: {ProfileLayout, Link},
    props: [
        'profile'
    ],
    data() {
        return {
            login: this.profile.user.login,
            firstName: this.profile.first_name,
            secondName: this.profile.second_name,
            thirdName: this.profile.third_name,
            gender: this.profile.gender,
            birthedAt: this.profile.birthed_at,
            aboutMe: this.profile.about_me,
            state: null
        }
    },
    mounted() {
        this.state = reactive({
            error: null,
        })
        this.state.error = new bootstrap.Modal('#errorModal', {})
    },
    methods: {
        update() {
            axios.patch(`/api/profiles/${this.profile.id}`, {
                first_name: this.firstName,
                second_name: this.secondName,
                third_name: this.thirdName,
                gender: this.gender,
                birthed_at: this.birthedAt,
                about_me: this.aboutMe,
            }).then(res => {
                this.$inertia.reload();
            }).catch(err => {
                if (err.response.data.message === 'not allowed'){
                    this.state.error.toggle();
                }
            });
        }
    }
}
</script>
