<template>
    <div class="dashboard-container">
      <h1>Welcome to your Dashboard</h1>
      <p>Here you can manage all your CRM data.</p>
      <div class="actions">
        <router-link to="/contacts" class="btn btn-primary">Manage Contacts</router-link>
        <router-link to="/interactions" class="btn btn-secondary">Track Interactions</router-link>
        <router-link to="/sales" class="btn btn-success">Manage Sales</router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Dashboard',
  };
  </script>
  
  <style scoped>
  .dashboard-container {
    text-align: center;
    padding: 20px;
  }
  
  .actions {
    margin-top: 20px;
  }
  
  .btn {
    padding: 10px 20px;
    margin: 10px;
    text-decoration: none;
  }
  
  .btn-primary {
    background-color: #007bff;
    color: white;
  }
  
  .btn-secondary {
    background-color: #6c757d;
    color: white;
  }
  
  .btn-success {
    background-color: #28a745;
    color: white;
  }
  </style>
  