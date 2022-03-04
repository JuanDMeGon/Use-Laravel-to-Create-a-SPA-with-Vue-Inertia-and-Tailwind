+<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
                <jet-button
                    class="
                        p-3
                        border-2
                        border-blue-500
                        text-blue-500
                        bg-blue-100
                        hover:bg-blue-200
                        font-bold
                        rounded-xl
                    "
                    @click="acting = true"
                >
                    Add New +
                </jet-button>

                <jet-modal :show="acting" closeable="true" @close="acting = null">
                    <div class="bg-gray-50 shadow-2xl p-8" v-else>
                        <form
                            class="flex flex-col items-center p-16"
                            @submit.prevent="submit"
                        >
                            <jet-input
                                class="px-5 py-3 w-96 border border-gray-600 rounded"
                                type="text"
                                name="title"
                                placeholder="Project title"
                                v-model="form.title"
                            ></jet-input>

                            <jet-input-error :message="form.errors.title"/>

                            <jet-input
                                class="mt-5 px-5 py-3 w-96 border border-gray-600 rounded"
                                type="text"
                                name="description"
                                placeholder="Project description"
                                v-model="form.description"
                            ></jet-input>

                            <jet-input-error :message="form.errors.description"/>

                            <select
                                class="w-96 border border-gray-600 rounded mt-5"
                                v-model="form.color"
                            >
                                <option value="">Select a color</option>
                                <option v-for="color in availableColors" :value="color">
                                    {{ color }}
                                </option>
                            </select>

                            <jet-input-error :message="form.errors.color"/>

                            <select
                                class="w-96 border border-gray-600 rounded mt-5"
                                v-model="form.icon_name"
                            >
                                <option value="">Select an icon</option>
                                <option v-for="icon in availableIcons" :value="icon">
                                    {{ icon }}
                                </option>
                            </select>

                            <jet-input-error :message="form.errors.icon_name"/>

                            <jet-button
                                class="px-5 py-3 mt-5 w-96 bg-purple-400 justify-center rounded-xl text-sm"
                                :disabled="form.processing"
                            >
                                <span class="animate-spin mr-1" v-show="form.processing">
                                    &#9696;
                                </span>

                                <span v-show="!form.processing">
                                    Submit
                                </span>
                            </jet-button>
                        </form>
                    </div>
                </jet-modal>
                <table v-if="projects.length > 0" class="w-full text-left">
                    <thead
                        class="border-b-2 border-gray-300 text-indigo-600"
                    >
                        <tr>
                            <th class="px-6 py-3 text-left">
                                Title
                            </th>
                            <th class="px-6 py-3 text-left">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left">
                                Color
                            </th>
                            <th class="px-6 py-3 text-left">
                                Icon
                            </th>
                            <th class="px-6 py-3 text-left">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="(project, index) in projects">
                        <tr
                            class="text-sm text-indigo-900 border-b border-gray-400"
                        >
                            <td class="px-6 py-4">
                                {{ project.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ project.description }}
                            </td>
                            <td class="px-6 py-4">
                                <p>
                                    <span class="mr-5 p-4 rounded" :class="project.color">
                                        {{ project.color }}
                                    </span>
                                </p>
                            </td>
                            <td class="px-6 py-4" :class="project.color">
                                <component :is="componentName(index)"></component>
                            </td>
                            <td class="px-6 py-4">
                                <jet-button
                                    class="border border-indigo-500 text-indigo-500 bg-indigo-50 hover:bg-indigo-100 mr-2"
                                >
                                    Edit
                                </jet-button>
                                <jet-button
                                    class="border border-red-500 text-red-500 bg-red-50 hover:bg-red-100 ml-2"
                                >
                                    Delete
                                </jet-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="bg-red-100 border border-red-400 p-3 rounded-lg text-red-800">
                    There are not projects yet. Let's create one :)
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineAsyncComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
    import JetModal from '@/Jetstream/Modal'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'

    export default {
        components: {
            AppLayout,
            JetButton,
            JetModal,
            JetInput,
            JetInputError,
        },
        props: {
            projects: Object,
            availableColors: Object,
            availableIcons: Object,
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
                this.form.submit('post', route('projects.store') , {
                    onSuccess: () => {
                        this.form.reset('title');
                        this.form.reset('description');
                        this.form.reset('color');
                        this.form.reset('icon_name');
                        this.acting = null;
                    }
                });
            }
        },
        data() {
            return {
                acting: null,
                form: this.$inertia.form({
                    'title': '',
                    'description': '',
                    'color': '',
                    'icon_name': '',
                }),
            }
        }
    }
</script>
