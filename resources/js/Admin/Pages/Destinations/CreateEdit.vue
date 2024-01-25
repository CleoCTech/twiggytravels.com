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
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Category</template>
                            <template #value>
                                <x-select v-model="form.category_id">
                                    <option value="">--select--</option>
                                    <option v-for="(category,index) in setup.categories" :key="index" :value="category.id">{{category.name}}</option>
                                </x-select>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-3">
                        <x-form-group>
                            <template #label>Cover Image</template>
                            <template #value>
                                <img v-if="show_image == '' && form.cover_image != null" :src="$page.props.storagePaths[setup.settings.storageName].cover_images.readPath+form.cover_image" class="h-20 w-20">
                                <input type="file" @input="onFileChange($event,'cover_image','show_image')" ref="input" class="shadow appearance-none border w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline disabled:opacity-40"/>
                                <img v-if="show_image != ''" :src="show_image" class="h-20 w-20">
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <div class="sm:col-span-3">
                        <div class="inline-block p-2" id="checkboxes" v-for="(holiday, index) in setup.holidays" :key="index" >
                            <input type="hidden" name="" v-model="form.holiday">
                            <input type="checkbox" :value="holiday.id" v-model="holiday.checked" @click="onCheckChange($event)"
                            class="rounded p-1 border-gray-300 text-indigo-600 shadow-sm
                            focus:border-indigo-300 focus:ring
                            focus:ring-indigo-200 focus:ring-opacity-50">
                            <label>{{holiday.name}}</label>
                        </div>
                    </div>
                    <x-grid-col class="sm:col-span-6">
                        <x-form-group class="sm:grid-cols-1">
                            <template #label>Content</template>
                            <template #value>
                                <ckeditor :editor="editor" v-model="form.content" @ready="cardData != null? form.content = cardData.content:''"></ckeditor>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col class="sm:col-span-6">
                        <x-form-group class="sm:grid-cols-1">
                            <template #label>Extra Info </template>
                            <template #value>
                                <ckeditor :editor="editor" v-model="form.extra_info" @ready="cardData != null? form.extra_info = cardData.extra_info:''"></ckeditor>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Validity</template>
                            <template #value><x-input type="text" v-model="form.validity" aria-placeholder="7 days" /></template>
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
                    <input
                    class="shadow appearance-none border w-full py-2 px-2 leading-tight focus:outline-none focus:shadow-outline disabled:opacity-40"
                    type="hidden" v-model="form.price" />
                    <input
                    class="shadow appearance-none border w-full py-2 px-2 leading-tight focus:outline-none focus:shadow-outline disabled:opacity-40"
                    type="hidden" v-model="form.priceStatus" />

                    <!-- <x-grid-col v-for="(priceCategory, index) in setup.priceCategories" :key="index">
                        <x-form-group>
                            <template #label>{{priceCategory.name}}</template>
                            <template #value><x-input type="text" :id="priceCategory.id" v-model="priceCategory.price"  @change="onPriceChange($event)"/></template>
                        </x-form-group>
                    </x-grid-col> -->

                </x-grid>
                <div class="grid grid-col-4 gap-4">
                        <div v-for="(priceCategory, index) in setup.priceCategories" :key="index" >
                            <label for="title" class="text-lx font-serif">{{priceCategory.name}} :</label>
                            <input type="text"  :id="priceCategory.id" v-model="priceCategory.price"
                            class="ml-2 outline-none py-1 px-2 text-md border-2 rounded-md" @change="onPriceChange($event)"/>

                            <label for="title" class="text-lx font-serif ml-4">Status:</label>
                            <select :id="priceCategory.id" v-model="priceCategory.status"
                            @change="onStatusChange($event)"
                            class="ml-4 text rounded border-2  text-gray-600 w-60 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                <option value="">--select--</option>
                                <option v-for="(status,index) in setup.priceStatuses"
                                :key="index"
                                :value="status.id"

                                >{{status.caption}}
                                </option>
                            </select>
                        </div>
                    </div>
                <div class="flex justify-center py-2">
                    <x-button type="submit">Submit</x-button>
                </div>
            </form>
        </x-create-edit-template>
    </div>
</template>
<script>
    import CreateEditMixin from '@/System/Mixins/CRUD/CreateEditMixin'

    export default{
        mixins:[CreateEditMixin],
        data(){
            return{
                form:{
                    uuid: null,
                    title: null,
                    category_id: null,
                    content: null,
                    extra_info: null,
                    cover_image: null,
                    validity: null,
                    status: null,
                    publish_time: null,
                    holiday: [],
                    price: [],
                    price2: [],
                    bindedHolidays: [],
                    priceStatus: [],
                    priceStatus2:[],
                },
                show_image:'',
            }
        },
        mounted(){
            this.form.price =  JSON.stringify( this.setup.bindedPriceIds);
            this.form.price2 =  this.setup.bindedPriceIds;
            this.form.priceStatus2 =  this.setup.bindedPriceStatuses;
            this.form.priceStatus =  JSON.stringify(this.setup.bindedPriceStatuses);
            console.log(this.setup.bindedPriceStatuses);
            console.log(this.setup.bindedPriceIds);
        },
        methods:{
            setData(){
                this.form.uuid = this.cardData.uuid;
                this.form.title = this.cardData.title;
                // this.form.content = this.cardData.content;
                this.form.cover_image = this.cardData.cover_image;
                this.form.validity = this.cardData.validity;
                this.form.status = this.cardData.status;
                this.form.category_id = this.cardData.category_id;
                this.form.publish_time = this.cardData.publish_time2;
                this.form.bindedHolidays = this.bindedHolidayIds;
                this.form.holiday = this.setup.bindedHolidayIds;
                this.form.price =  JSON.stringify( this.setup.bindedPriceIds);
                this.form.price2 =  this.setup.bindedPriceIds;
                this.form.priceStatus2 =  this.setup.bindedPriceStatuses;
                this.form.priceStatus =  JSON.stringify(this.setup.bindedPriceStatuses);
                console.log(this.setup.bindedPriceStatuses);
                console.log(this.setup.bindedPriceIds);
            },
            onCheckChange(event){
                console.log(this.form.holiday);
                if (event.target.checked) {
                    this.form.holiday.push(event.target.value);
                    console.log(this.form.holiday);
                } else {
                    console.log("Value", +event.target.value);
                    var value = event.target.value;
                    var holidayIndex = this.form.holiday.indexOf(value);//get  id index
                    console.log("Index Value: " + holidayIndex);
                    if (holidayIndex !== -1) {
                        this.form.holiday.splice(holidayIndex, 1);
                    }
                }
            },
            onPriceChange(event){

                if (this.form.price2.hasOwnProperty(event.target.id)) {
                    this.form.price2[event.target.id] = event.target.value;
                    this.form.price = JSON.stringify(this.form.price2);
                    console.log(this.form.price);
                } else {
                    console.log(event.target.id);
                    this.form.price2 = [event.target.id, event.target.value];
                    this.form.price = JSON.stringify(this.form.price2);
                    console.log(this.form.price);
                }
            },
            onStatusChange(event){
                if (this.form.priceStatus.hasOwnProperty(event.target.id)) {
                    this.form.priceStatus2[event.target.id] = event.target.value;
                    this.form.priceStatus = JSON.stringify(this.form.priceStatus2);
                    console.log(this.form.priceStatus);
                } else {
                    this.form.priceStatus2 = [event.target.id, event.target.value];
                    this.form.priceStatus = JSON.stringify(this.form.priceStatus2);
                    console.log(this.form.priceStatus);
                }

            }
        }
    }
</script>
<style scoped>
    /* #checkboxes input {
        display: inline-block;
        margin-right:10px;
    }
    #checkboxes label {
        display: inline-block;
        margin-right:10px;
    } */
</style>
