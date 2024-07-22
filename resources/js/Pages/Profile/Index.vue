<template>
    <ProfileLayout>
        <div v-if="profiles.length > 0" class="row row-cols-1 row-cols-md-3 g-4 mb-3">
            <div v-for="profile in profiles" class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ profile.user.login }}</h5>
                        <p class="card-text">{{ profile.first_name }} {{ profile.second_name }}</p>
                        <Link class="btn btn-primary" :href="route('profile.show', profile.id)">Details...</Link>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="card mb-3" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">There is not profiles</h5>
            </div>
        </div>

    </ProfileLayout>
</template>
<script>
import ProfileLayout from "@/Layouts/ProfileLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {
        ProfileLayout,
        Link
    },
    props: [
        'profiles'
    ]
}
</script>
