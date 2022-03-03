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

                <div class="flex items-end border-b-2 border-gray-500 pb-2">
                    <p class="
                        font-bold
                        mr-5
                        text-gray-500
                        text-xl
                    ">
                        Want to know more?
                    </p>

                    <jet-button class="
                        bg-green-400
                        rounded
                        font-bold
                        text-sm
                        text-gray-800
                        hover:bg-green-800
                    ">
                        Let's chat
                    </jet-button>
                </div>
            </div>

            <div class="animate-pulse mt-3 text-gray-300 text-center text-9xl">
                <a href="#skills">&#8675;</a>
            </div>
        </Section>

        <Section id="skills" class="bg-gray-200 text-gray-800 h-screen">
            <h2 class="text-6xl font-bold pt-3">Skills</h2>

            <div class="grid grid-cols-2">
                <div v-for="skill in skills">
                    <Skill :background="skill.color">
                        {{ skill.name }}
                    </Skill>
                </div>
            </div>

            <div class="flex justify-center mt-10">
                <jet-button class="
                    bg-indigo-800
                    rounded
                    font-bold
                    text-sm
                    text-gray-200
                    hover:bg-indigo-700
                ">
                    Get in touch
                </jet-button>
            </div>

        </Section>

        <Section class="bg-gray-600 text-gray-200 h-screen">
            <h2 class="text-6xl font-bold pt-3">Projects</h2>

            <div v-for="project in projects">
                <Project
                    :title="project.title"
                    :description="project.description"
                    :color="project.color"
                >
                    <BeakerIcon></BeakerIcon>
                </Project>
            </div>

            <div class="flex justify-center mt-10">
                <jet-button class="
                    bg-purple-100
                    rounded
                    font-bold
                    text-sm
                    text-gray-800
                    hover:bg-purple-200
                ">
                    Know more
                </jet-button>
            </div>

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
                <Link class="border-b pb-1 px-2 hover:text-gray-50" href="#">
                    GitHub
                </Link>
                <Link class="border-b pb-1 px-2 hover:text-gray-50" href="#">
                    Twitter
                </Link>
                <Link class="border-b pb-1 px-2 hover:text-gray-50" href="#">
                    StackOverflow
                </Link>
            </div>
        </Section>
    </div>
</template>
<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'

    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetButton from '@/Jetstream/Button'

    import Section from '@/Components/Section'
    import Skill from '@/Components/Skill'
    import Project from '@/Components/Project'

    import { BeakerIcon } from '@heroicons/vue/solid'

    export default defineComponent({
        components: {
            Head,
            Link,
            JetApplicationMark,
            JetButton,
            Section,
            Skill,
            Project,
            BeakerIcon,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            skills: Object,
            projects: Object,
        }
    })
</script>
