<template>
  <card title="Create Contact">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" message="Contact has been created successfully" />

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Name</label>
        <div class="col-md-7">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" name="name">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <!-- Phone -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Phone</label>
        <div class="col-md-7">
          <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" name="phone">
          <has-error :form="form" field="phone" />
        </div>
      </div>

      <!-- Email -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Email</label>
        <div class="col-md-7">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <!-- Address -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Address</label>
        <div class="col-md-7">
          <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" name="address">
          <has-error :form="form" field="address" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            Create
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      address: '',
      phone: '',
    })
  }),

  methods: {
    async update () {
      await this.form.post('/api/contacts/store')

      this.form.reset()
    }
  }
}
</script>
