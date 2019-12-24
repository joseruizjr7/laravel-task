<template>
    <div>
        <h2 class="mb-2">Subscribers</h2>
        <form @submit.prevent="addSub" class="mb-3">
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" placeholder="" v-model="subscriber.email">
            </div>
            <div class="form-group">
                <label for="">Name</label>
                <input class="form-control" placeholder="" v-model="subscriber.name">
            </div>
            <div class="form-group">
                <label for="select_status">State</label>
                <select class="custom-select" id="select_status" v-model="subscriber.state">
                    <option value="active" selected>Active</option>
                    <option value="unsubscribed">Unsubscribed</option>
                    <option value="junk">Junk</option>
                    <option value="bounced">Bounced</option>
                    <option value="unconfirmed">Unconfirmed</option>
                    
                </select>
            </div>
            
            <button type="submit" class="btn btn-light btn-block">Save</button>
        </form>
        <div class="card card-body mb-3" v-for="subscriber in subscribers" v-bind:key="subscriber.id">
            <h3>Name: {{ subscriber.name }}</h3>
            <h4>Email: {{ subscriber.email }}</h4>
            <h4>State: {{ subscriber.state }}</h4>
            <hr>
            <button @click="editSub(subscriber)" class="btn btn-warning mb-2">Edit</button>
            <button @click="deleteSub(subscriber.id)" class="btn btn-danger">Delete</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            subscribers: [],
            subscriber: {
                id: '',
                email: '',
                name: '',
                state: ''
            },
            subscriber_id: '',
            pagination: {},
            edit: false
        }
    },

    created() {
        this.fetchSubscibers();
    },

    methods: {
        fetchSubscibers() {
            fetch('api/subscribers')
                .then(res => res.json())
                .then(res => {
                    this.subscribers = res.data;
                })
        },
        deleteSub(id) {
            if (confirm('Are you sure?')) {
                fetch(`api/subscriber/${id}`, {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    alert('Subscriber removed succesfully!');
                    this.fetchSubscibers();
                })
                .catch(err => console.log(err));
            }
        },
        addSub() {
            if (this.edit === false) {
                fetch('api/subscriber', {
                    method: 'post',
                    body: JSON.stringify(this.subscriber),
                    headers: {
                        'content_type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.clearForm();
                    alert('Subscriber added succesfully!');
                    this.fetchSubscibers();
                })
                .catch(err => console.log(err));
            } else {
                //Update
                fetch('api/subscriber', {
                    method: 'put',
                    body: JSON.stringify(this.subscriber),
                    headers: {
                        'content_type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.clearForm();
                    alert('Subscriber updated succesfully!');
                    this.fetchSubscibers();
                })
                .catch(err => console.log(err));
            }
        },
        editSub(subscriber) {
            this.edit = true;
            this.subscriber.id = subscriber.id;
            this.subscriber.subscriber_id = subscriber.id;
            this.subscriber.email = subscriber.email;
            this.subscriber.name = subscriber.name;
            this.subscriber.state = subscriber.state;
        },
        clearForm() {
            this.edit = false;
            this.subscriber.id = null;
            this.subscriber.subscriber_id = null;
            this.subscriber.email = '';
            this.subscriber.name = '';
            this.subscriber.state = '';
        }
    }
}
</script>