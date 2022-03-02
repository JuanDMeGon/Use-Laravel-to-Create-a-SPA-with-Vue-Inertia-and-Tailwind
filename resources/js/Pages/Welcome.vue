<template>
    <Head title="Welcome"/>

    <Section class="
        grid
        grid-cols-2
        text-right
        bg-gray-800
        text-gray-300
    ">
        <div>
            <jet-application-mark class="h-12 w-auto"></jet-application-mark>
        </div>
        <div v-if="canLogin">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm underline">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-base underline">
                    Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="text-base underline place-self-end ml-4">
                    Register
                </Link>
            </template>
        </div>
    </Section>

    <div>
        <Section
            class="
                bg-gray-800
                pt-16
                h-screen
            "
        >
            <div class="h-2/3 flex flex-wrap content-between pb-36">
                <p
                    class="
                        border-b-2
                        font-bold
                        border-gray-400
                        pb-3
                        text-2xl
                        text-gray-300
                        uppercase
                    "
                >
                    Hey! This is Juan. I'm a Senior Software Engineer and I would be glad to work with you.
                </p>
            </div>
        </Section>

        <Section class="bg-gray-200 text-gray-800 h-screen">
            <h2 class="text-6xl font-bold pt-3">Skills</h2>
        </Section>

        <Section class="bg-gray-600 text-gray-200 h-screen">
            <h2 class="text-6xl font-bold pt-3">Projects</h2>
        </Section>

        <Section
            class="
                flex
                justify-between
                bg-gray-800
                text-gray-300
                text-xl
            "
        >
            <p>&copy; JuanDMeGon. All right reserved.</p>
            <div class="flex justify-evenly items-center">
                GitHub
                Twitter
                StackOverflow
            </div>
        </Section>
    </div>
</template>
<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import Section from '@/Components/Section'

    export default defineComponent({
        components: {
            Head,
            Link,
            JetApplicationMark,
            Section
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        }
    })
</script>
