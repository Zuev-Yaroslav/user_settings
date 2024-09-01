<template>
    <header class="p-3 w-full bg-white shadow">
        <div class="w-3/4 flex mx-auto justify-between">
            <div class="flex">
                <div>
                    <Link :href="route('profiles.index')">Profiles</Link>
                </div>
            </div>
        </div>

    </header>
    <div class="md:m-0 md:my-4 m-4">
        <slot/>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "MainLayout",
    components: {
        Link
    },
}
</script>

<style scoped>

</style>
