<template>
  <div>
    <h1>Wardrobe</h1>
    <div v-if="user">
      <button @click="logout">Logout</button>
    </div>
    <div>
      <input v-model="search" placeholder="Search clothing" />
      <select v-model="category">
        <option value="all">All</option>
        <option value="shirts">Shirts</option>
        <option value="pants">Pants</option>
      </select>
      <button @click="fetchClothes">Search</button>
    </div>
    <ul>
      <li v-for="clothing in clothes" :key="clothing.id">
        <h3>{{ clothing.name }}</h3>
        <p>{{ clothing.category }}</p>
        <p>{{ clothing.size }} - {{ clothing.color }}</p>
        <button @click="deleteClothing(clothing.id)">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      clothes: [],
      search: '',
      category: 'all',
    };
  },
  computed: {
    user() {
      return this.$store.state.user;
    }
  },
  methods: {
    async fetchClothes() {
      const response = await axios.get('http://localhost:8000/api/clothes', {
        params: { search: this.search, category: this.category },
      });
      this.clothes = response.data;
    },
    async deleteClothing(id) {
      await axios.delete(`http://localhost:8000/api/clothes/${id}`);
      this.fetchClothes();
    },
    logout() {
      this.$store.dispatch('logout');
    }
  },
  mounted() {
    if (this.user) {
      this.fetchClothes();
    }
  }
};
</script>
