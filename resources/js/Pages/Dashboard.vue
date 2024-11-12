<template>
    <div class="layout">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="logo">
          <h2>CRM</h2>
        </div>
        <nav class="nav">
          <ul>
            <li><a href="/customers"><i class="bi bi-person-fill"></i> Customers</a></li>
            <li><a href="/customers/create"><i class="bi bi-person-plus-fill"></i> Create Customer</a></li>
            <li><button @click="logout" class="btn-logout"><i class="bi bi-box-arrow-right"></i> Logout</button></li>
          </ul>
        </nav>
      </div>
  
      <!-- Main Content -->
      <div class="main-content">
        <div class="header">
          <h1>Welcome Back to Your CRM Dashboard</h1>
          <p class="tagline">Manage, grow, and optimize your customer relationships with ease.</p>
        </div>
  
        <!-- Dashboard Cards -->
        <div class="cards-container">
          <div class="card customers full-width-card">
            <div class="card-title">Recent Customers</div>
            <div class="card-body">
              <table v-if="recentCustomers.length">
                <thead>
                  <tr>
                    <th class="th-name">Name</th>
                    <th class="th-email">Email</th>
                    <th class="th-company">Company</th>
                    <th class="th-actions">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="customer in recentCustomers" :key="customer.id">
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.company }}</td>
                    <td><a :href="'/customers/' + customer.id + '/edit'" class="btn-edit">Edit</a></td>
                  </tr>
                </tbody>
              </table>
              <p v-else>No recent customers available.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      recentCustomers: {
        type: Array,
        default: () => [],
      },
    },
    methods: {
      logout() {
        this.$inertia.post('/logout');
      },
    },
  };
  </script>
  
  <style scoped>
  /* Global Styles */
  body {
    font-family: 'Helvetica', sans-serif;
    margin: 0;
    background: #f9f9f9;
    color: #333;
  }
  
  a {
    text-decoration: none;
  }
  
  h1, h2, h3, p {
    margin: 0;
  }
  
  /* Layout Styles */
  .layout {
    display: flex;
    height: 100vh;
  }
  
  /* Sidebar Styling */
  .sidebar {
    width: 250px;
    background: linear-gradient(135deg, #7b68ee, #48c6ef);
    color: white;
    padding: 20px;
  }
  
  .logo h2 {
    font-size: 2.5rem;
    margin-bottom: 30px;
    font-weight: bold;
  }
  
  .nav ul {
    list-style: none;
    padding: 0;
  }
  
  .nav ul li {
    margin-bottom: 20px;
  }
  
  .nav ul li a {
    font-size: 1.2rem;
    color: white;
    display: flex;
    align-items: center;
    padding: 12px;
    transition: background 0.3s ease;
  }
  
  .nav ul li a:hover {
    background-color: rgba(255, 255, 255, 0.2);
  }
  
  .nav ul li .btn-logout {
    background: #e74c3c;
    border: none;
    color: white;
    font-size: 1.1rem;
    padding: 12px 20px;
    border-radius: 5px;
    width: 100%;
  }
  
  .nav ul li .btn-logout:hover {
    background: #c0392b;
  }
  
  /* Main Content Styles */
  .main-content {
    flex-grow: 1;
    padding: 30px;
  }
  
  .header h1 {
    font-size: 2.5rem;
    color: #2c3e50;
  }
  
  .tagline {
    font-size: 1.2rem;
    color: #7f8c8d;
    margin-top: 10px;
  }
  
  /* Dashboard Cards */
  .cards-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-top: 30px;
  }
  
  /* Card Styles */
  .card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    padding: 20px;
    text-align: left;
    margin-bottom: 20px;
  }
  
  .card-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 20px;
  }
  
  .card-body {
    font-size: 1.1rem;
    color: #7f8c8d;
  }
  
  /* Full Width Card Styling for Recent Customers */
  .full-width-card {
    width: 100%;
  }
  
  /* Table Styles */
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  th {
    font-size: 1.1rem;
    font-weight: bold;
    color: #333;
  }
  
  td {
    font-size: 1.1rem;
    color: #555;
  }
  
  th.th-name, td:nth-child(1) {
    width: 25%;
  }
  
  th.th-email, td:nth-child(2) {
    width: 25%;
  }
  
  th.th-company, td:nth-child(3) {
    width: 25%;
  }
  
  th.th-actions, td:nth-child(4) {
    width: 25%;
  }
  
  .btn-edit {
    background: #3498db;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    transition: background 0.3s ease;
  }
  
  .btn-edit:hover {
    background: #2980b9;
  }
  </style>
  