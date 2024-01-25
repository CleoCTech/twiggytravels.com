<template>
    <div>
        <x-index-template :setup="setup" :listData="listData" :selected="selected">
            <x-table>
                <template #thead>
                    <x-tableth-checkbox v-if="isMultipleSelect"/>
                    <x-tableth>Name</x-tableth>
                    <x-tableth>Phone No.</x-tableth>
                    <x-tableth>Email</x-tableth>
                    <x-tableth>Date</x-tableth>
                    <x-tableth>Service</x-tableth>
                    <x-tableth>From Time</x-tableth>
                    <x-tableth>To Time</x-tableth>
                    <x-tableth>Status</x-tableth>
                </template>
                <template #tbody>
                    <x-tabletr v-for="(record,index) in listData.data" v-bind:key="index" :row="record.uuid+'#'+index" :isSelected="isSelected(record.uuid+'#'+index)" :url="setup.settings.indexRoute+'/show/'+record.uuid">
                        <x-tabletd-checkbox v-if="isMultipleSelect" :item="record.uuid+'#'+listData.data.indexOf(record)" @onCheck="onCheck"/>
                        <x-tabletd>{{record.name}}</x-tabletd>
                        <x-tabletd>{{record.phone_no}}</x-tabletd>
                        <x-tabletd>{{record.email}}</x-tabletd>
                        <x-tabletd>{{record.date}}</x-tabletd>
                        <x-tabletd>{{record.service.title}}</x-tabletd>
                        <x-tabletd>{{record.timeslot.from_time}}</x-tabletd>
                        <x-tabletd>{{record.timeslot.to_time}}</x-tabletd>
                        <x-tabletd>
                            <x-badge :class="setup.statuses[setup.statuses.findIndex(x => x.id ==record.status)].color">{{setup.statuses[setup.statuses.findIndex(x => x.id ==record.status)].caption}}</x-badge>
                        </x-tabletd>
                    </x-tabletr>
                </template>
            </x-table>
        </x-index-template>
    </div>
</template>
<script setup>
    // import IndexMixin from '@/System/Mixins/CRUD/IndexMixin.js'
    import { provide, getCurrentInstance } from 'vue'
    import { indexProps, useIndex } from '@/Composables/useIndex'

    const context = getCurrentInstance()?.appContext.config.globalProperties;
    
    // const props = defineProps(indexProps)
    const props = defineProps({...indexProps})
    console.log(props.listData.data);

    const { 
        selected,
        onCheck,
        onRowClick,
        isSelected,
        xTable,
        xTabletd,
        xTabletdCheckbox,
        xTablethCheckbox,
        xTableth,
        xTabletr,
        xBadge,
        xIndexTemplate, isMultipleSelect} = useIndex(props)
   
    const showLoading = () => {
        context.$showLoading()
        setTimeout(() => {
            context.$hideLoading()
        }, 2000)
    }
    provide('onRowClick', onRowClick);
    provide('isMultipleSelect', isMultipleSelect);
    
</script>
