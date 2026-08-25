<script setup>
import Table from './Providers/Table.vue';
import Form from './Providers/Form.vue';
</script>

<template>
    <Table ref="table" :url="url" @load-record="onLoadRecord" @delete-record="onDeleteRecord"/>
    <Form ref="form" :url="url" @refresh-records="onRefreshRecords"/>
</template>

<script>
export default {
    emits: [],
    props: {
        url: {
            type: String,
            default: 'http://localhost:8000',
        },
    },
    data() {
        return {};
    },
    computed: {},
    methods: {
        onLoadRecord(id) {
            this.$refs['form'].getRecord(id);
        },
        onDeleteRecord(id) {
            this.$refs['form'].deleteRecord(id);
        },
        onRefreshRecords() {
            this.$refs['table'].getRecords();
        }
    },
    created() {},
    mounted() {},
};
</script>

<style scoped>

</style>
