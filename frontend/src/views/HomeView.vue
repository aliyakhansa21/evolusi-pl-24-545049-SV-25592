<script setup>
import { ref, onMounted } from 'vue'

const tasks = ref([])
const errorMsg = ref('')
const loading = ref(true)

const apiUrl = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000'

onMounted(async () => {
  try {
    const res = await fetch(`${apiUrl}/api/tasks`)
    if (!res.ok) throw new Error('Gagal mengambil data dari server')
    tasks.value = await res.json()
  } catch (err) {
    errorMsg.value = 'Tidak dapat terhubung ke server Laravel: ' + err.message
  } finally {
    loading.value = false
  }
})
</script>

<template>
  <main style="padding: 20px;">
    <h1>Daftar Tugas dari Laravel</h1>
    <p v-if="loading">Memuat data...</p>
    <p v-else-if="errorMsg" style="color: red;">{{ errorMsg }}</p>
    <ul v-else>
      <li v-for="task in tasks" :key="task.id">
        {{ task.title || task.name || JSON.stringify(task) }}
      </li>
      <li v-if="tasks.length === 0">Belum ada data tugas di database.</li>
    </ul>
  </main>
</template>