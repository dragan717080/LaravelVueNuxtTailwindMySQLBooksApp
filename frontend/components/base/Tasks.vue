<template lang="html">
  <section
    class="max-w-screen-xl mx-2 sm:mx-auto px-4 sm:px-6 lg:px-0 py-6 pb-20 sm:py-8 rounded-[2.25rem] sm:rounded-xl bg-white transform lg:-translate-y-12 shadow-xl mt-48"
  >
  <div class="max-w-3xl mx-auto text-center">
    <h2 class="text-3xl font-extrabold sm:text-4xl">
      Svi <span class="text-header-gradient">zadaci</span> koje ste sačuvali
    </h2>
    <p class="mt-4 text-lg dark:text-gray-400 mb-20">Zabavite se rešavajući zadatke!</p>
  </div>
  <div v-if="!isOpen && !isUpdatePortalOpen">
    <div 
      v-for="(taskChunk, index) in taskChunks"
      :key="index" 
      class="sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-4 px-2 lg:px-10 mb-5"
      >
      <!-- Nested v-for to iterate through each chunk of tasks -->
      <div v-for="(task, taskIndex) in taskChunk" :key="taskIndex" class="flex" @click="updateIsCompleted(task)">
        <div class="mt-1 5">
          <div v-if="task.isCompleted">
            <SvgCorrect />
          </div>
        <div v-else>X</div>
        </div>
        <div class="ml-3">
          <dt class="text-lg bold">{{ task.title }}</dt>
          <dd class="hidden sm:block mt-2 dark:text-gray-400">
            {{ task.description }}
          </dd>
          <div class="row-v my-6 space-x-6">
            <button 
            class="bg-blue-gradient text-sm text-center rounded-lg
            hover:shadow-md hover:shadow-[#0c66ee]/50 transition duration-300
            max-w-full px-5 py-2 border border-[#0c66ee] text-white shadow-md"
            @click="openUpdatePortal(task.id)"
            >
              Izmeni
            </button>
            <button 
            class="bg-red-gradient text-sm text-center rounded-lg
            hover:shadow-md hover:shadow-[#e22929]/50 transition duration-300
            max-w-full px-5 py-2 border border-[#e22929] text-white shadow-md"
            @click="deleteTask(task.id); $event.stopPropagation()"
            >
              Obriši
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="w-full flex flex-col lg:flex-row items-center justify-center">
      <div class="light:bg-white-800 light:text-darkgray-100 -mt-20">
        <div data-aos="fade-up" class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="row-h mt-2">
            <BaseButton
              class="max-w-full px-8 py-4 bg-gradient-to-r from-[#468ef9] to-[#0c66ee] border border-[#0c66ee] text-white shadow-md hover:shadow-xl active:scale-90 transition duration-150"
              v-if="!isOpen && !isUpdatePortalOpen"
              @click="openPortal"
            >
              Dodaj zadatak <span aria-hidden="true">→</span>
            </BaseButton>
          </div>
          <!-- Update -->
          <div v-bind:class="{ 'block': isUpdatePortalOpen, 'hidden': !isUpdatePortalOpen }">
            <form @submit.prevent="updateTask">
              <div class="mt-9 mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Ime zadatka</label>
                <input
                  type="text"
                  id="title"
                  name="title"
                  v-model="updateFormData.title"
                  class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                  :placeholder="this.activeTask.title"
                />
              </div>
              <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Opis zadatka</label>
                <textarea
                  id="description"
                  name="description"
                  v-model="updateFormData.description"
                  rows="4"
                  class="mt-1 p-2 w-full border border-gray-300 rounded-md resize-none"
                  :placeholder="this.activeTask.description"
                ></textarea>
              </div>
              <button
                type="submit"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 mt-10"
              >
                Sačuvaj
              </button>
            </form>
          </div>
          <!-- Post -->
          <div v-if="isOpen">
            <form @submit.prevent="createTask">
              <div class="mt-9 mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Ime zadatka</label>
                <input
                  type="text"
                  id="title"
                  name="title"
                  v-model="formData.title"
                  class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                  placeholder="Napiši ime zadatka"
                />
              </div>
              <div class="mb-16">
                <label for="description" class="block text-sm font-medium text-gray-600">Opis zadatka</label>
                <textarea
                  id="description"
                  name="description"
                  v-model="formData.description"
                  rows="4"
                  class="mt-1 p-2 w-full border border-gray-300 rounded-md resize-none"
                  placeholder="Napiši opis zadatka"
                ></textarea>
              </div>
              <button
                type="submit"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300"
              >
                Sačuvaj
              </button>
              <button
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 ml-10"
                @click="this.closePortal()"
              >
                Otkaži
              </button>
            </form>
            </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import SvgCorrect from '../SvgCorrect.vue'

// Dirty solution - bolje da sam stavio u .env fajl
const BASE_URL = 'http://127.0.0.1:8000/'

export default {
  name: 'Tasks',
  components: { SvgCorrect },
  data() {
    return {
      isOpen: false,
      isUpdatePortalOpen: false,
      tasks: [],
      activeTask: {},
      formData: {
        title: '',
        description: '',
      },
      updateFormData: {
        ...this.formData,
        id: '',
      },
    }
  },
  async created() {
    this.tasks = await this.getTasks()
    this.tasks = this.tasks.data
  },
  methods: {
    openPortal() {
      this.isOpen = true
    },
    closePortal() {
      this.formData.title = ''
      this.formData.description = ''
      this.isOpen = false
    },
    openUpdatePortal(id) {
      this.activeTask = this.tasks.find((element) => element.id === id)
      this.updateFormData.id = id
      this.isUpdatePortalOpen = true
    },
    closeUpdatePortal() {
      this.updateFormData.id = ''
      this.updateFormData.title = ''
      this.updateFormData.description = ''
      this.isUpdatePortalOpen = false
    },
    async getTasks() {
      const response = await axios.get(BASE_URL)
      this.tasks = response.data
      return response.data
    },
    async createTask() {
      if (!this.formData.title || !this.formData.description) {
        return
      }

      const response = await axios.post(BASE_URL, {
        title: this.formData.title,
        description: this.formData.description,
      })

      this.tasks.push(response.data.data)
      this.closePortal()
    },
    async updateTask() {
      const response = await axios.patch(`${BASE_URL}${this.activeTask.id}`, this.updateFormData)
      this.activeTask = response.data.data
      this.closeUpdatePortal()
      const index = this.tasks.map((task) => task.id).indexOf(this.activeTask.id)
      this.$set(this.tasks, index, this.activeTask)
    },
    async updateIsCompleted(task) {
      await axios.patch(`${BASE_URL}${task.id}`, { isCompleted: !task.isCompleted })
      const index = this.tasks.map((task) => task.id).indexOf(task.id)
      this.$set(this.tasks, index, { ...this.tasks[index], isCompleted: !task.isCompleted })
    },
    async deleteTask(id) {
      await axios.delete(`${BASE_URL}${id}`)
      this.tasks = this.tasks.filter((task) => task.id !== id)
    },
  },
  computed: {
    taskChunks() {
      if (!this.tasks.length) {
        return
      }
      // Chunk tasks into groups of 4
      const chunkSize = 4
      return this.tasks.reduce((acc, task, index) => {
        const chunkIndex = Math.floor(index / chunkSize)

        if (!acc[chunkIndex]) {
          acc[chunkIndex] = []
        }

        acc[chunkIndex].push(task)

        return acc
      }, [])
    },
  },
}
</script>

<style scoped>
</style>
