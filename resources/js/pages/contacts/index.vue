<template>
  <card title="Contact List">
    <div>
    <router-link :to="{ name: 'contacts.store' }" class="btn btn-primary">Create Contact</router-link>
    </div>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col">Address</th>
          <th scope="col">Options</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(contact, index) in contacts" v-bind:key="index">
          <th>{{contact.name}}</th>
          <th>{{contact.phone}}</th>
          <th>{{contact.email}}</th>
          <th>{{contact.address}}</th>
          <th>
            <router-link :to="{name : 'contacts.update', params: { id: contact.id }}" class="btn btn-primary">Update</router-link>
            <button class="btn btn-danger" @click="prepDelete(contact.id)">Delete</button>
          </th>
        </tr>
        <tr v-if="contacts.length == 0">
          <th colspan="5" class="text-center">
            <p class="font-weight-light text-muted">No Contacts</p>
            <div>
              <router-link :to="{ name: 'contacts.store' }" class="btn btn-primary">Create Contact</router-link>
            </div>
          </th>
        </tr>
      </tbody>
    </table>
  </card>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  scrollToTop: false,
  middleware: 'auth',

  metaInfo () {
    return { title: 'Contact List' }
  },

  data: () => ({
    contacts: []
  }),

  methods: {
    async getContacts () {
      const {data} = await axios.get('/api/contacts')
      this.contacts = data
    },
    async prepDelete(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(async (result) => {
        if (result.value) {
          await axios.delete(`/api/contacts/${id}`)
          this.getContacts()
          Swal.fire(
            'Deleted!',
            'Your contact has been deleted.',
            'success'
          )
        }
      })
    }
  },

  mounted(){
    this.getContacts()
  }
}
</script>
