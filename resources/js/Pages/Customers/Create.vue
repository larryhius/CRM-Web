<template>
  <div>
    <h2>Create Customer</h2>
    <form @submit.prevent="createCustomer">
      <div>
        <label>Name:</label>
        <input v-model="form.name" type="text" required />
      </div>
      <div>
        <label>Email:</label>
        <input v-model="form.email" type="email" required />
      </div>
      <div>
        <label>Company:</label>
        <input v-model="form.company" type="text" />
      </div>
      <div>
        <label>Phone:</label>
        <input v-model="form.phone" type="text" />
      </div>
      <div>
        <label>Address:</label>
        <textarea v-model="form.address"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Save</button>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        company: '',
        phone: '',
        address: '',
      },
    };
  },
  methods: {
    createCustomer() {
      Inertia.post('/customers', this.form);
    },
  },
};
</script>
