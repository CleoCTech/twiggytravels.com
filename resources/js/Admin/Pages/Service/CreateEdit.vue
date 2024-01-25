<template>
    <div>
        <x-create-edit-template :setup="setup" :selected="selected">
            <form v-on:submit.prevent="submit" action="#" method="POST" enctype="multipart/form-data">
                <x-grid>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Title</template>
                            <template #value><x-input type="text" v-model="form.title"/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-3">
                        <x-form-group class="sm:grid-cols-1">
                            <template #label>Summary</template>
                            <template #value>
                                <ckeditor v-cloak :editor="editor" v-model="form.summary" @ready="cardData != null? form.summary = cardData.summary :'' "></ckeditor>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-3">
                        <x-form-group class="sm:grid-cols-1">
                            <template #label>Content</template>
                            <template #value>
                                <ckeditor v-cloak :editor="editor" v-model="form.content" @ready="cardData != null? form.content = cardData.content : '' "></ckeditor>
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
                    <x-grid-col class="col-span-3">
                        <x-form-group>
                            <template #label>Svg</template>
                            <template #value><x-input type="text" v-model="form.svg"/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-2">
                        <x-form-group>
                            <template #label>Cover Image</template>
                            <template #value>
                                <img v-if="show_image == '' && form.cover_image != null && form.cover_image != 'null'" :src="$page.props.storagePaths[setup.settings.storageName].posts.readPath+form.cover_image" class="h-20 w-20">
                                <x-input type="file"  @input="onFileChange($event,form.cover_image, show_image)" ref="input" class="shadow appearance-none border w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline disabled:opacity-40"/>
                                <img v-if="show_image != ''" :src="show_image" class="h-20 w-20">
                            </template>
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
    // import CreateEditMixin from '@/System/Mixins/CRUD/CreateEditMixin.js'
    import { createEditProps, useCreateEdit } from '@/Composables/useCreateEdit'
    import { ref, reactive, computed  } from 'vue'

    const props = defineProps({...createEditProps})

    const form = reactive({
        uuid: null,
        title: null,
        summary: null,
        cover_image: null,
        svg: null,
        content: null,
        status: null,
        publish_time: null,
    })
    
    const show_image = ref('')

    function setData(){
        if (props.cardData != null && props.cardData.uuid != null) {
            form.uuid = props.cardData.uuid;
            form.title = props.cardData.title;
            form.summary = props.cardData.summary;
            form.content = props.cardData.content;
            form.cover_image = props.cardData.cover_image;
            form.svg = props.cardData.svg;
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
