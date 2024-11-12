<template>
    <div class="main-content">
      <div class="header">
        <h1>Manage Interactions</h1>
        <p class="tagline">Track all your interactions with customers like email, phone calls, and meetings.</p>
      </div>
  
      <div class="actions">
        <button class="btn-add" @click="openAddInteractionModal">Add Interaction</button>
      </div>
  
      <!-- Interactions Table -->
      <div class="card">
        <div class="card-title">Recent Interactions</div>
        <div class="card-body">
          <table v-if="interactions.length">
            <thead>
              <tr>
                <th>Customer</th>
                <th>Type</th>
                <th>Details</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="interaction in interactions" :key="interaction.id">
                <td>{{ interaction.customer.name }}</td>
                <td>{{ interaction.type }}</td>
                <td>{{ interaction.details }}</td>
                <td>{{ interaction.interaction_date }}</td>
                <td>
                  <button @click="editInteraction(interaction)" class="btn-edit">Edit</button>
                  <button @click="deleteInteraction(interaction.id)" class="btn-delete">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
          <p v-else>No interactions found.</p>
        </div>
      </div>
  
      <!-- Modal to Add New Interaction -->
      <div v-if="showAddModal" class="modal-overlay">
        <div class="modal-content">
          <h3>Add New Interaction</h3>
          <form @submit.prevent="addInteraction">
            <div class="form-group">
              <label for="customer_id">Customer</label>
              <select v-model="newInteraction.customer_id" id="customer_id" required>
                <option value="">Select Customer</option>
                <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                  {{ customer.name }}
                </option>
              </select>
            </div>
  
            <div class="form-group">
              <label for="type">Interaction Type</label>
              <input type="text" v-model="newInteraction.type" id="type" required placeholder="e.g., Email, Phone Call, Meeting" />
            </div>
  
            <div class="form-group">
              <label for="details">Details</label>
              <textarea v-model="newInteraction.details" id="details" required placeholder="Interaction details..."></textarea>
            </div>
  
            <div class="form-group">
              <label for="interaction_date">Interaction Date</label>
              <input type="datetime-local" v-model="newInteraction.interaction_date" id="interaction_date" required />
            </div>            
  
            <button type="submit" class="btn-submit">Add Interaction</button>
            <button @click="closeAddInteractionModal" class="btn-cancel">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      interactions: {
        type: Array,
        required: true,
      },
      customers: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        showAddModal: false,
        newInteraction: {
          customer_id: '',
          type: '',
          details: '',
          interaction_date: '', // Added to store the date of interaction
        },
      };
    },
    methods: {
      openAddInteractionModal() {
        this.showAddModal = true;
      },
      closeAddInteractionModal() {
        this.showAddModal = false;
        this.newInteraction = {
          customer_id: '',
          type: '',
          details: '',
          interaction_date: '', // Reset interaction date on modal close
        };
      },
      async addInteraction() {
        try {
          await this.$inertia.post('/interactions', this.newInteraction);
          this.closeAddInteractionModal();
        } catch (error) {
          console.error('Error adding interaction:', error);
        }
      },
      editInteraction(interaction) {
        // This will open the edit modal or redirect to an edit page
        console.log('Editing interaction', interaction);
      },
      async deleteInteraction(interactionId) {
        if (confirm('Are you sure you want to delete this interaction?')) {
          await this.$inertia.delete(`/interactions/${interactionId}`);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add your custom styles here */
  .main-content {
    padding: 30px;
  }
  
  .header h1 {
    font-size: 2.5rem;
    color: #2c3e50;
  }
  
  .actions {
    margin-top: 20px;
  }
  
  .btn-add {
    background-color: #3498db;
    color: white;
    padding: 12px 20px;
    border-radius: 5px;
    font-size: 1.1rem;
  }
  
  .card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
  }
  
  .card-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #2c3e50;
  }
  
  .card-body {
    font-size: 1rem;
    color: #7f8c8d;
  }
  
  .table {
    width: 100%;
    margin-top: 20px;
  }
  
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal-content {
    background: white;
    padding: 30px;
    border-radius: 10px;
    width: 500px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-group label {
    font-weight: bold;
  }
  
  .form-group input,
  .form-group textarea,
  .form-group select {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    margin-top: 5px;
  }
  
  .btn-submit,
  .btn-cancel {
    padding: 12px 20px;
    font-size: 1.1rem;
    border-radius: 5px;
  }
  
  .btn-submit {
    background-color: #2ecc71;
    color: white;
  }
  
  .btn-cancel {
    background-color: #e74c3c;
    color: white;
  }
  
  .btn-submit:hover,
  .btn-cancel:hover {
    opacity: 0.8;
  }
  </style>
  