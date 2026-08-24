<template>
    <fieldset class="form">
        <div class="form-element">
            <input type="number" name="id" v-model="record['id']" disabled>
        </div>
        <div class="form-element">
            <input type="text" name="name" placeholder="Name.." v-model="record['name']">
        </div>
        <div class="form-element">
            <input type="text" name="description" placeholder="Description.." v-model="record['description']">
        </div>
        <div class="form-element">
            <input type="text" name="url" placeholder="Url.." v-model="record['url']">
        </div>
        <div class="form-element">
            <input type="checkbox" name="active" id="active" v-model="record['active']">
            <label for="active">Active</label>
        </div>
        <div class="form-element">
            <input type="checkbox" name="rfResident" id="rfResident" v-model="record['rfResident']">
            <label for="rfResident">Resident of Russian Federation</label>
        </div>
        <div class="form-element">
            <input type="checkbox" name="needProxy" id="needProxy" v-model="record['needProxy']">
            <label for="needProxy">Need proxy</label>
        </div>
        <button @click="submit">Submit</button>
        <button @click="clear">Clear</button>
    </fieldset>
</template>
<script>
export default {
    emits: [
        'refreshRecords',
    ],
    props: {
        url: {
            type: String,
            default: 'localhost',
        },
    },
    data() {
        return {
            record: {
                id: null,
                name: null,
                description: null,
                url: null,
                active: false,
                rfResident: false,
                needProxy: false,
            },
        };
    },
    computed: {},
    methods: {
        async getRecord(id) {
            const url = `${this.url}/provider/${id}`;
            const response = await fetch(url, {method: 'GET'});

            try {
                if (response.ok) {
                    const result = await response.json();

                    this.record['id'] = result['id'];
                    this.record['name'] = result['name'];
                    this.record['description'] = result['description'];
                    this.record['url'] = result['url'];
                    this.record['active'] = result['active'];
                    this.record['rfResident'] = result['rfResident'];
                    this.record['needProxy'] = result['needProxy'];
                } else {
                    console.error('Server error');
                }
            } catch {
                console.error('Fatal error');
            }
        },
        async postRecord() {
            const url = `${this.url}/provider/post`;
            const response = await fetch(url, {method: 'POST', body: JSON.stringify(this.record)});

            try {
                if (response.ok) {
                    const result = await response.json();

                    this.record['id'] = result['id'];
                    this.record['name'] = result['name'];
                    this.record['description'] = result['description'];
                    this.record['url'] = result['url'];
                    this.record['active'] = result['active'];
                    this.record['rfResident'] = result['rfResident'];
                    this.record['needProxy'] = result['needProxy'];
                } else {
                    console.error('Server error');
                }
            } catch {
                console.error('Fatal error');
            }
        },
        async patchRecord() {
            const url = `${this.url}/provider/patch/${this.record['id']}`;
            const response = await fetch(url, {method: 'PATCH', body: JSON.stringify(this.record)});

            try {
                if (response.ok) {
                    const result = await response.json();

                    this.record['id'] = result['id'];
                    this.record['name'] = result['name'];
                    this.record['description'] = result['description'];
                    this.record['url'] = result['url'];
                    this.record['active'] = result['active'];
                    this.record['rfResident'] = result['rfResident'];
                    this.record['needProxy'] = result['needProxy'];
                } else {
                    console.error('Server error');
                }
            } catch {
                console.error('Fatal error');
            }
        },
        async deleteRecord(id) {
            const url = `${this.url}/provider/delete/${id}`;
            const response = await fetch(url, {method: 'DELETE'});

            try {
                if (response.ok) {
                    const result = await response.json();
                    this.$emit('refreshRecords');
                } else {
                    console.error('Server error');
                }
            } catch {
                console.error('Fatal error');
            }
        },
        async submit() {
            if (this.record['id'] === null) {
                await this.postRecord();
            } else {
                await this.patchRecord();
            }
            this.$emit('refreshRecords');
        },
        clear() {
            this.record['id'] = null;
            this.record['name'] = null;
            this.record['description'] = null;
            this.record['url'] = null;
            this.record['active'] = false;
            this.record['rfResident'] = false;
            this.record['needProxy'] = false;
        },
    },
    created() {},
    mounted() {},
};
</script>

<style scoped>
    .form {
        display: flex;
        flex-direction: column;
        width: 50vw;
        margin-top: 50px;
    }
    .form-element {
        flex: 1;
        align-items: flex-start;
        width: 100%;
        margin-bottom: 5px;
    }
    .form-element input[type=text],
    .form-element input[type=number] {
        flex: 1;
        width: 100%;
    }
</style>
