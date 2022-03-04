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
                        hover:bg-green-800"

                        @click="contacting = true"
                    >
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
                    hover:bg-indigo-700"

                    @click="contacting = true"
                >
                    Get in touch
                </jet-button>
            </div>

        </Section>

        <Section class="bg-gray-600 text-gray-200 h-screen">
            <h2 class="text-6xl font-bold pt-3">Projects</h2>

            <div v-for="(project, index) in projects">
                <Project
                    :title="project.title"
                    :description="project.description"
                    :color="project.color"
                >
                    <component :is="componentName(index)"></component>
                </Project>
            </div>

            <div class="flex justify-center mt-10">
                <jet-button class="
                    bg-purple-100
                    rounded
                    font-bold
                    text-sm
                    text-gray-800
                    hover:bg-purple-200"

                    @click="contacting = true"
                >
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
    <jet-modal :show="contacting" closeable="true" @close="contacting=null">
        <div class="bg-gray-50 shadow-2xl p-8">
            <p class="text-gray-600 text-2xl font-extrabold text-center">Let me know some details</p>

            <form
                class="flex flex-col items-center p-16"
                @submit.prevent="submit"
            >
                <jet-input
                    class="px-5 py-3 w-96 border border-gray-600 rounded"
                    type="email"
                    name="email"
                    placeholder="Your email"
                    v-model="form.email"
                ></jet-input>

                <textarea
                    class="px-5 py-3 w-96 border border-gray-600 rounded mt-5"
                    name="message"
                    placeholder="The details :)"
                    v-model="form.message"
                ></textarea>

                <jet-button
                    class="px-5 py-3 mt-5 w-96 bg-purple-400 justify-center rounded-xl text-sm"
                >
                    Get in touch
                </jet-button>
            </form>
        </div>

    </jet-modal>
</template>
<script>
    import { defineComponent, defineAsyncComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'

    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetButton from '@/Jetstream/Button'
    import JetModal from '@/Jetstream/Modal'
    import JetInput from '@/Jetstream/Input'

    import Section from '@/Components/Section'
    import Skill from '@/Components/Skill'
    import Project from '@/Components/Project'

    export default defineComponent({
        components: {
            Head,
            Link,
            JetApplicationMark,
            JetButton,
            JetModal,
            JetInput,
            Section,
            Skill,
            Project,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            skills: Object,
            projects: Object,
        },

        methods: {
            componentName(index) {
                return defineAsyncComponent(() =>
                    import  (
                        '@heroicons/vue/solid/'
                        + this.projects[index].icon_name
                        + 'Icon.js'
                    )
                );
            },
            submit()
            {
                this.form.post(route('contact'));
            }
        },
        data() {
            return {
                contacting: null,
                form: this.$inertia.form({
                    'email': '',
                    'message': '',
                }),
            }
        }
    })
</script>
