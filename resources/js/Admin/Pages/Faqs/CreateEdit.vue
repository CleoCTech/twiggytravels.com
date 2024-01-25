<template>
    <div>
        <x-create-edit-template :setup="setup" :selected="selected">
            <form v-on:submit.prevent="submit" action="#" method="POST" enctype="multipart/form-data">
                <x-grid>
                    <x-grid-col class="col-span-3">
                        <x-form-group>
                            <template #label>Question</template>
                            <template #value><x-input type="text" v-model="form.question"/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-6">
                        <x-form-group class="sm:grid-cols-1">
                            <template #label>Answer</template>
                            <template #value>
                                <ckeditor v-cloak :editor="editor" v-model="form.answer" @ready="cardData != null? form.answer = cardData.answer :''"></ckeditor>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Status</template>
                            <template #value>
                                <x-select v-model="form.status">
                                    <option value="">--select--</option>
                                    <option v-for="(status,index) in setup.statuses" :key="index" :value="status.id">{{status.caption}}</option>
                                </x-select>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col v-if="form.status == 3">
                        <x-form-group>
                            <template #label>Publish Time</template>
                            <template #value><x-input type="datetime-local" v-model="form.publish_time"/></template>
                        </x-form-group>
                    </x-grid-col>
                </x-grid>
                <div class="flex justify-center py-2">
                    <x-button type="submit">Submit</x-button>
                </div>
            </form>
        </x-create-edit-template>
    </div>
</template>
<script setup>
import { createEditProps, useCreateEdit } from '@/Composables/useCreateEdit'
    import { ref, reactive, computed  } from 'vue'

    const props = defineProps({...createEditProps})

    const form = reactive({
        uuid: null,
        question: null,
        answer: null,
        status: null,
        publish_time: null,
    })
    
    const show_image = ref('')

    function setData(){
        if (props.cardData != null && props.cardData.uuid != null) {
            form.uuid = props.cardData.uuid;
            form.question = props.cardData.question;
            form.answer = props.cardData.answer;
            form.status = props.cardData.status;
            form.publish_time = props.cardData.publish_time2;
        }
        
    }
    
    const { editor,editorConfig, submit, onFileChange, ckeditor, xGrid,
        xFormGroup,
        xGridCol,
        xLoading,
        xPanel,
        xInput,
        xSelect,
        xTextarea,
        xCheckbox,
        xButton,
        AppLayout,
        xCreateEditTemplate, TextInput } = useCreateEdit(props, setData, form )
    
</script>
