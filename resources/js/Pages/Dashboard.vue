<template>
  <div class="bg-gray-100">
    <main class="h-screen p-6 flex">
      <!-- card -->
      <div class="mr-6 w-80 bg-white shadow-lg rounded-lg">
        <div class="flex items-center border-b border-gray-200 px-4 py-5 sm:px-6">
          <img :src="self.avatar" class="mr-4 h-10 w-10 rounded-full" />
          <div>
            <h2 class="text-indigo-900 text-lg font-semibold">{{ self.name }}</h2>
            <p class="text-indigo-700">Online</p>
          </div>
        </div>
        <div class>
          <draggable v-model="self.tasks" ghost-class="ghost" @change="changed">
            <div v-for="(task, n) in self.tasks" :key="n" class="px-4 py-5 sm:p-6 border-b">
              <div v-html="task.content"></div>
              <div class="-mb-6 -mx-6 p-3 text-right">
                <button @click="finish(task.id)">Complete</button>
              </div>
            </div>
          </draggable>

          <div class="mt-auto bg-indigo-900 text-white px-4 py-2 font-semibold">Create Task</div>
          <div
            class="px-4 py-5 sm:p-6 border-b bg-indigo-100"
            contenteditable="true"
            @blur="create"
          ></div>
        </div>
      </div>

      <!-- wide card -->
      <div
        class="flex-1 flex bg-white overflow-x-scroll shadow-lg rounded-lg"
        style="scroll-snap-type: x mandatory;"
      >
        <div
          v-for="(user, n) in $page.users"
          :key="n"
          class="w-80 flex-shrink-0"
          :class="n !== users.length - 1 ? 'border-r' : ''"
          style="scroll-snap-align: start;"
        >
          <div class="flex items-center bg-white border-b border-gray-200 px-4 py-5 sm:px-6">
            <img :src="user.avatar" class="mr-4 h-10 w-10 rounded-full" />
            <div>
              <h2 class="text-indigo-900 text-lg font-semibold">{{ user.name }}</h2>
              <p class="text-indigo-700">Online</p>
            </div>
          </div>
          <div class>
            <draggable v-model="user.tasks" ghost-class="ghost">
              <div
                v-for="(task, n) in user.tasks"
                :key="n"
                class="px-4 py-5 sm:p-6 border-b"
                v-html="task.content"
              ></div>
            </draggable>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import draggable from "vuedraggable";

export default {
  components: {
    draggable
  },

  data() {
    return {};
  },

  computed: {
    self() {
      return this.$page.self;
    },
    users() {
      return this.$page.users;
    }
  },

  methods: {
    changed() {
      this.$inertia.patch(`/users/${this.self.id}/tasks`, {
        tasks: this.self.tasks
      });
    },
    create(value) {
      this.$inertia.post(`/users/${this.self.id}/tasks`, {
        task: value.target.innerHTML
      });

      value.target.innerHTML = "";
    },
    finish(id) {
      this.$inertia.delete(`/users/${this.self.id}/tasks/${id}`);
    }
  }
};
</script>

<style scoped>
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}
</style>
