+<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Skills
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <table v-if="skills.length > 0" class="w-full">
                    <thead
                        class="border-b-2 border-gray-300 text-indigo-600"
                    >
                        <tr>
                            <th class="px-6 py-3 text-left">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left">
                                Color
                            </th>
                            <th class="px-6 py-3 text-left">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="skill in skills">
                        <tr
                            class="text-sm text-indigo-900 border-b border-gray-400"
                        >
                            <td class="px-6 py-4">
                                {{ skill.name }}
                            </td>
                            <td class="px-6 py-4">
                                <p>
                                    <span class="mr-5 p-4 rounded" :class="skill.color"></span>
                                    {{ skill.color }}
                                </p>
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
                    There are no skills yet. Let's create one :)
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'

    export default {
        components: {
            AppLayout,
            JetButton
        },
        props: {
            skills: Object,
        }
    }
</script>
