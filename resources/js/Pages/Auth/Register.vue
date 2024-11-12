<template>
    <div class="login-container">
      <div class="login-card">
        <h2 class="text-center mb-4">Create Account</h2>
  
        <form @submit.prevent="handleRegister">
          <!-- Email -->
          <div class="mb-3">
            <input
              v-model="form.email"
              type="email"
              id="email"
              class="form-control"
              placeholder="Email"
              required
            />
            <small v-if="errors.email" class="text-danger">{{ errors.email }}</small>
          </div>
  
          <!-- Username -->
          <div class="mb-3">
            <input
              v-model="form.username"
              type="text"
              id="username"
              class="form-control"
              placeholder="Username"
              required
            />
            <small v-if="errors.username" class="text-danger">{{ errors.username }}</small>
          </div>
  
          <!-- Password -->
          <div class="mb-4">
            <input
              v-model="form.password"
              type="password"
              id="password"
              class="form-control"
              placeholder="Password"
              required
            />
            <small v-if="errors.password" class="text-danger">{{ errors.password }}</small>
          </div>
  
          <!-- Confirm Password -->
          <div class="mb-4">
            <input
              v-model="form.password_confirmation"
              type="password"
              id="password_confirmation"
              class="form-control"
              placeholder="Confirm Password"
              required
            />
            <small v-if="errors.password_confirmation" class="text-danger">{{ errors.password_confirmation }}</small>
          </div>
  
          <!-- Submit Button -->
          <div class="mb-4">
            <button type="submit" class="btn btn-success btn-block">Create Account</button>
          </div>
  
          <!-- Error Message -->
          <div v-if="errorMessage" class="alert alert-danger mt-3">
            {{ errorMessage }}
          </div>
  
          <!-- Login Link -->
          <div class="text-center">
            <a href="/login" class="text-muted">Already have an account? Login</a>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          email: '',
          username: '',
          password: '',
          password_confirmation: '',
        },
        errors: {},
        errorMessage: '',
      };
    },
    methods: {
      async handleRegister() {
        this.errors = {};
        this.errorMessage = '';
  
        try {
          const response = await axios.post('/register', this.form);
          if (response.status === 200) {
            window.location.href = '/dashboard';
          }
        } catch (error) {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
            this.errorMessage = 'Something went wrong. Please try again!';
          }
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Full-screen container with gradient background */
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(45deg, #4e73df, #6f42c1); /* Blue to Purple Gradient */
    font-family: 'Arial', sans-serif;
  }
  
  /* Styling for the login card */
  .login-card {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 40px;
    border-radius: 30px; /* More oval curve */
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  h2 {
    font-size: 24px;
    color: #333;
  }
  
  input {
    border-radius: 25px; /* More rounded */
    padding: 14px;
    background-color: #f7f7f7;
    color: #333;
    border: 1px solid #ddd;
    width: 100%;
  }
  
  input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }
  
  button {
    border-radius: 25px; /* More rounded */
    font-size: 18px;
    font-weight: bold;
    background-color: #28a745; /* Green button */
    border: none;
    color: white;
    width: 100%; /* Same width as inputs */
  }
  
  button:hover {
    background-color: #218838;
  }
  
  .alert-danger {
    font-size: 14px;
    padding: 10px;
    border-radius: 8px;
    background-color: #dc3545;
    color: white;
  }
  
  .text-center a {
    font-size: 14px;
    color: #007bff;
    text-decoration: none;
  }
  
  .text-center a:hover {
    text-decoration: underline;
  }
  </style>
  