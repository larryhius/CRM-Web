<template>
  <div class="login-container">
    <div class="login-card">
      <h2 class="text-center mb-4">Sign In</h2>

      <form @submit.prevent="handleLogin">
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

        <!-- Submit Button -->
        <div class="mb-4">
          <button type="submit" class="btn btn-success btn-block">Login</button>
        </div>

        <!-- Error Message -->
        <div v-if="errorMessage" class="alert alert-danger mt-3">
          {{ errorMessage }}
        </div>

        <!-- Forgot Password Link -->
        <div class="text-center">
          <a href="#" class="text-muted">Forgot your password?</a>
        </div>

        <!-- Create Account Link -->
        <div class="text-center mt-3">
          <p class="text-muted">Don't have an account? <a href="/register" class="text-primary">Create one</a></p>
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
        username: '',
        password: '',
      },
      errors: {},
      errorMessage: '',
    };
  },
  methods: {
    async handleLogin() {
      this.errors = {};
      this.errorMessage = '';

      try {
        const response = await axios.post('/login', this.form);
        if (response.status === 200) {
          window.location.href = '/dashboard';
        }
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;
        } else {
          this.errorMessage = 'Invalid username or password!';
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
