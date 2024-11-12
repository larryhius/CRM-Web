<template>
  <div>
    <h2>Customer List</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Company</th>
          <th>Email</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.id">
          <td>{{ customer.name }}</td>
          <td>{{ customer.company }}</td>
          <td>{{ customer.email }}</td>
          <td>{{ customer.phone }}</td>
        </tr>
      </tbody>
    </table>
    <router-link :to="{ name: 'customers.create' }" class="btn btn-primary">Add Customer</router-link>
  </div>
</template>

<script>
export default {
  props: {
    customers: Array,
  },
};
</script>
