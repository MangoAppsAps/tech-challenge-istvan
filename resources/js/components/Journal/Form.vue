<template>
    <div>
        <h1 class="mb-6">Clients -> {{ client.name }} -> Add New Journal</h1>

        <div class="max-w-lg mx-auto">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" class="form-control" v-model="journal.date">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" v-model="journal.description"></textarea>
            </div>

            <div class="text-right">
                <a :href="`/clients/${client.id}`" class="btn btn-default">Cancel</a>
                <button @click="storeJournal" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'JournalForm',

    props: [
        'client',
    ],

    data() {
        return {
            journal: {
                date: null,
                description: '',
            }
        }
    },

    methods: {
        storeJournal() {
            axios.post(`/clients/${this.client.id}/journals`, this.journal)
                .then((data) => {
                    window.location.href = data.data.client.url;
                });
        }
    }
}
</script>
